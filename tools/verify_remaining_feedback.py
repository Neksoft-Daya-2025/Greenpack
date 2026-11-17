"""Targeted checks for the remaining email feedback on the live preview."""
import concurrent.futures
import json
from pathlib import Path

import requests
from bs4 import BeautifulSoup

BASE = 'https://greenpack.neksoftconsultancy.in'


def check(path):
    response = requests.get(BASE + path, timeout=35)
    assert response.status_code == 200, (path, response.status_code)
    soup = BeautifulSoup(response.text, 'html.parser')
    english = path.startswith('/en/')
    text = soup.get_text(' ', strip=True)
    news = 'News & Media' if english else 'Noutăți și media'
    permits = 'Permits & Certifications' if english else 'Autorizații și certificări'
    nav = soup.select_one('.elementskit-navbar-nav')
    assert nav and news in nav.get_text(' ', strip=True), path
    assert permits in nav.get_text(' ', strip=True), path
    if 'blog/' in path:
        main = soup.select_one('main')
        assert main.h1.get_text(strip=True) == news, path
        assert not any(t in main.get_text() for t in ['Hello world!', 'OUR BLOG', 'De la gunoi la comori']), path
        assert main.select_one('video[controls] source[src$="GPK_v2.5.mp4"]'), path
        assert len(main.select('.gp-info-card')) == 3, path
    elif 'autorizatii-certificari/' in path:
        main = soup.select_one('main')
        assert main.h1.get_text(strip=True) == permits, path
        label = 'Request information and documents' if english else 'Solicită informații și documente'
        assert main.select_one('.gp-feedback-button').get_text(strip=True) == label, path
    elif 'instalatii-echipamente/' in path:
        assert '105,000+ tonnes/year' in text if english else '105.000+ tone/an' in text, path
        if english:
            assert '105.000 tone/an' not in text and 'Infrastructură' not in text, path
    else:
        heading = soup.select_one('[data-id="4a70f53"]').get_text(strip=True)
        assert heading == ('We look forward to your message' if english else 'Așteptăm mesajul tău'), path
        if english:
            assert 'The services provided were fast, efficient and reliable.' in text, path
            assert 'Serviciile oferite' not in text, path
    if 'blog/' in path or 'autorizatii-certificari/' in path:
        for link in main.select('a[href^="/"]'):
            if link['href'].startswith('/wp-content/'):
                continue
            assert link['href'].startswith('/en/') == english, (path, link['href'])
    return {'path': path, 'status': response.status_code, 'result': 'PASS'}


if __name__ == '__main__':
    paths = [prefix + page for prefix in ['/', '/en/'] for page in ['', 'blog/', 'autorizatii-certificari/', 'instalatii-echipamente/']]
    with concurrent.futures.ThreadPoolExecutor(max_workers=4) as pool:
        results = list(pool.map(check, paths))
    result = requests.get(BASE + '/hello-world/', timeout=30)
    assert result.status_code == 404, result.status_code
    Path('evidence/mail-audit/remaining-http-verification.json').write_text(json.dumps(results, indent=2), encoding='utf-8')
    print('PASS: 8 Romanian/English pages, translated navigation and links, media video, capacity and testimonial; demo post returns 404')
