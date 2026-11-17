"""Verify the supplied-reference image updates on both language versions."""
import concurrent.futures
import json
import urllib.request
from pathlib import Path

from bs4 import BeautifulSoup

BASE = 'https://greenpack.neksoftconsultancy.in/'
PAGES = {
    'waste-management/': 'waste-management',
    'sortare-deseuri/': 'sorting',
    'reciclare/': 'recycling',
    'distrugere-controlata/': 'controlled-destruction',
    'servicii-curatenie/': 'cleaning',
}


def check_page(path):
    with urllib.request.urlopen(BASE + path, timeout=35) as response:
        assert response.status == 200
        soup = BeautifulSoup(response.read(), 'html.parser')
    name = PAGES[path.removeprefix('en/')]
    image = soup.select_one('[data-id="2c1dc93"] img')
    assert image and '/greenpack-v3-reference/' + name in image['src'], path
    assert ('illustrative visual' if path.startswith('en/') else 'vizual ilustrativ') in image['alt'], (path, image['alt'])
    assert soup.select_one('[data-id="5335662"] .elementor-counter-number')['data-to-value'] == '100'
    return {'path': '/' + path, 'status': 200, 'main_image': image['src'], 'alt': image['alt']}


if __name__ == '__main__':
    paths = list(PAGES) + ['en/' + p for p in PAGES]
    with concurrent.futures.ThreadPoolExecutor(max_workers=3) as executor:
        pages = list(executor.map(check_page, paths))
    assets = []
    for name in list(PAGES.values()) + ['national-map-v2']:
        url = BASE + 'wp-content/uploads/2026/11/greenpack-v3-reference/' + name + '.webp'
        with urllib.request.urlopen(urllib.request.Request(url, method='HEAD'), timeout=25) as response:
            assert response.status == 200
            assert response.headers.get('Content-Type', '').startswith('image/')
            assets.append({'url': url, 'status': 200})
    result = {'pages': pages, 'assets': assets, 'result': 'PASS'}
    Path('evidence/reference-v3/http-visual-verification.json').write_text(json.dumps(result, indent=2, ensure_ascii=False), encoding='utf-8')
    print(f'PASS: {len(pages)} translated service pages, image labels, specialist counts, and {len(assets)} assets')
