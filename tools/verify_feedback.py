"""Check the feedback outcomes against the live Romanian and English pages."""
import concurrent.futures
import json
import subprocess
import urllib.error
import urllib.request
from pathlib import Path

from bs4 import BeautifulSoup

BASE = 'https://greenpack.neksoftconsultancy.in/'
PAGES = ['', 'about-us/', 'servicii-colectare/', 'comercializare-deseuri/', 'waste-management/', 'sortare-deseuri/', 'reciclare/',
         'distrugere-controlata/', 'servicii-curatenie/', 'instalatii-echipamente/',
         'prezenta-nationala/', 'flota-auto/']


def inspect(path):
    last_error = None
    for attempt in range(2):
        try:
            with urllib.request.urlopen(BASE + path, timeout=35) as response:
                html = response.read().decode()
                assert response.status == 200
            break
        except (TimeoutError, urllib.error.URLError) as error:
            last_error = error
    else:
        raise last_error
    soup = BeautifulSoup(html, 'html.parser')
    english = path.startswith('en/')
    name = path.removeprefix('en/')
    header = soup.select_one('[data-id="4a8f7ad"] .ekit_creative_button_text, [data-id="5c0344c"] .ekit_creative_button_text')
    assert header and header.get_text(strip=True) == ('Get In Touch' if english else 'Contactează-ne'), path
    assert soup.select_one('link[href*="greenpack-feedback-v3/style.css"]'), path
    counter = soup.select_one('[data-id="5335662"] .elementor-counter-number')
    if counter:
        assert counter['data-to-value'] == '100', path
        assert soup.select_one('[data-id="5335662"] .elementor-counter-number-suffix').get_text(strip=True) == '+'
    if name == '':
        link = soup.select_one('[data-id="122238f"] a')
        assert link and '/about-us/' in link['href'], 'CEO link'
    if name == 'about-us/':
        assert not soup.select('[data-id="da2c0be"] .elementor-widget-elementskit-content-ticker')
        assert soup.select_one('[data-id="097dd53"] .number-percentage')['data-value'] == '100'
        assert soup.select_one('[data-id="097dd53"] h2').get_text(strip=True) == ('Dedicated specialists' if english else 'Specialiști dedicați')
    if name in ['sortare-deseuri/', 'reciclare/', 'distrugere-controlata/', 'servicii-curatenie/']:
        main = soup.select_one('[data-id="2c1dc93"] img')
        assert main
        unwanted = ['infrastructura/img-03.webp', 'infrastructura/img-06.webp', 'service-entry-info-image.jpg', 'service-entry-video-image.jpg']
        for image in soup.select('[data-id="2c1dc93"] img, [data-id="899f68b"] img, [data-id="66a2a61"] img'):
            assert not any(value in image['src'] for value in unwanted), (path, image['src'])
    if name == 'instalatii-echipamente/':
        galleries = soup.select('.gp-infra-gallery')
        assert galleries and all(len(g.select('figure')) == 15 for g in galleries)
    if name == 'flota-auto/':
        stats = [x.get_text(' ', strip=True) for x in soup.select('.gp-infra-stat')]
        assert any('120+' in x and ('collection vehicles of all sizes' if english else 'vehicule de colectare de toate dimensiunile') in x for x in stats), stats
        assert not any('electric' in x for x in stats), stats
    if name == '':
        scripts = [s.get_text() for s in soup.find_all('script') if not s.get('src') and s.get('type', '') in ['', 'text/javascript', 'application/javascript']]
        result = subprocess.run(['node', '-e', 'let s="";process.stdin.on("data",d=>s+=d);process.stdin.on("end",()=>JSON.parse(s).forEach(x=>new Function(x)));'], input=json.dumps(scripts), text=True, capture_output=True)
        assert result.returncode == 0, result.stderr
    return {'path': '/' + path, 'status': 200, 'content_checks': 'PASS'}


class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, *args, **kwargs):
        return None


if __name__ == '__main__':
    paths = PAGES + ['en/' + p for p in PAGES]
    with concurrent.futures.ThreadPoolExecutor(max_workers=3) as executor:
        results = list(executor.map(inspect, paths))
    redirects = []
    for language in ['', 'en/']:
        old = language + 'flota-auto-electrice/'
        try:
            urllib.request.build_opener(NoRedirect).open(BASE + old, timeout=25)
            raise AssertionError('Old fleet URL did not redirect')
        except urllib.error.HTTPError as response:
            assert response.code == 301
            assert response.headers['Location'] == BASE + language + 'flota-auto/'
            redirects.append({'path': '/' + old, 'status': 301, 'target': response.headers['Location']})
    report = {'pages': results, 'redirects': redirects, 'result': 'PASS'}
    Path('evidence/http-verification.json').write_text(json.dumps(report, indent=2), encoding='utf-8')
    print(f'PASS: {len(results)} pages, content checks, inline JavaScript syntax, and {len(redirects)} permanent redirects')
