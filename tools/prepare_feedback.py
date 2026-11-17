"""Prepare the narrowly scoped WordPress content updates from the saved snapshot."""
import copy
import json
import re
from pathlib import Path

before = json.loads(Path('evidence/before.json').read_text(encoding='utf-8'))
base = 'https://greenpack.neksoftconsultancy.in'
old = base + '/wp-content/uploads/greenpack-old/'
diagram = base + '/wp-content/mu-plugins/greenpack-feedback-v3/controlled-destruction.svg'
cleaning = base + '/wp-content/uploads/2026/09/cleaning-services-cover.png'
images = {
    12833: [old + 'infrastructura/img-07.webp', old + 'infrastructura/img-05.webp', old + 'infrastructura/img-02.webp'],
    12834: [old + 'infrastructura/img-02.webp', old + 'infrastructura/img-07.webp', old + 'infrastructura/img-04.webp'],
    12835: [old + 'echipamente/img-10.webp', old + 'echipamente/img-15.webp', old + 'echipamente/img-02.webp'],
    12836: [diagram, diagram, diagram],
    12838: [cleaning, cleaning, cleaning],
}
captions = [
    'Linie de reciclare', 'Echipament de procesare', 'Bandă transportoare',
    'Instalație de procesare', 'Echipament de mărunțire', 'Linie de transport și procesare',
    'Instalație de reciclare', 'Separator de materiale', 'Transportul materialelor',
    'Linie de procesare a materialelor', 'Transportul materialelor', 'Echipament industrial',
    'Instalație de tratare', 'Sistem de alimentare', 'Linie de extrudare',
]


def replace_route(value):
    if isinstance(value, str):
        return value.replace('/flota-auto-electrice/', '/flota-auto/')
    if isinstance(value, dict):
        return {k: replace_route(v) for k, v in value.items()}
    if isinstance(value, list):
        return [replace_route(v) for v in value]
    return value


changes = []
for page in before['pages']:
    data = replace_route(json.loads(page['elementor'] or '[]'))
    page_id = page['id']

    def walk(elements):
        for widget in elements:
            settings = widget.get('settings', {})
            widget_id = widget['id']
            if widget.get('widgetType') == 'counter' and 'Specialiști' in settings.get('title', ''):
                settings.update(ending_number=100, suffix='+')
            if page_id == 680 and widget_id == 'f2bc42e':
                settings['ending_number'] = 100
            if page_id == 680 and widget_id == '122238f':
                settings['ekit_btn_url']['url'] = base + '/about-us/'
            if page_id == 2113:
                if widget_id in ['097dd53', '626fdc7']:
                    for key in ['ekit_funfact_number', 'ending_number', 'number']:
                        if key in settings:
                            settings[key] = 100
                if widget_id == '097dd53':
                    settings['ekit_funfact_title_text'] = 'Specialiști dedicați'
                if widget_id == '481fe58':
                    widget.update(widgetType='text-editor', elType='widget', elements=[])
                    widget['settings'] = {'editor': '<p>Echipa noastră susține fiecare etapă a gestionării responsabile a deșeurilor.</p><ul><li>Colectare și sortare</li><li>Reciclare și valorificare</li><li>Soluții adaptate fiecărui partener</li></ul>'}
                    settings = widget['settings']
            if page_id in images:
                selected = images[page_id]
                if widget_id == '8881760':
                    settings['background_image'].update(url=selected[0], id='', alt='')
                if widget_id in ['2c1dc93', '899f68b', '66a2a61']:
                    index = ['2c1dc93', '899f68b', '66a2a61'].index(widget_id)
                    alt = 'Procesul de distrugere controlată — ilustrație' if page_id == 12836 else 'Servicii profesionale de curățenie' if page_id == 12838 else page['title']
                    settings['image'].update(url=selected[index], id='', alt=alt, size='full')
            for key in ['editor', 'html']:
                text = settings.get(key)
                if not isinstance(text, str):
                    continue
                if page_id == 12844:
                    text = re.sub(r'(<strong>\s*120\+\s*</strong>\s*)mașini electrice', r'\1vehicule de colectare de toate dimensiunile', text)
                    text = text.replace('Mașini electrice Renault', 'Vehicule pentru colectare')
                    text = re.sub(r'Green Pack își transformă flota prin adăugarea de mașini\s+electrice pentru colectarea sustenabilă a deșeurilor\.', 'Green Pack utilizează vehicule de diferite dimensiuni, adaptate colectării și transportului deșeurilor.', text)
                if page_id == 12842:
                    def gallery(match):
                        parts = re.findall(r'<img[^>]+src="([^"]+)"[^>]*>', match.group(1))
                        figures = []
                        for i, url in enumerate(parts):
                            caption = captions[i]
                            figures.append(f'<figure><img src="{url}" alt="{caption} Green Pack" loading="lazy" /><figcaption>{caption}</figcaption></figure>')
                        return '<div class="gp-infra-gallery">' + ''.join(figures) + '</div>'
                    text = re.sub(r'<div class="gp-infra-gallery">(.*?)</div>', gallery, text, flags=re.S)
                settings[key] = text
            walk(widget.get('elements', []))

    walk(data)
    original = json.loads(page['elementor'] or '[]')
    if data != original:
        changes.append({'id': page_id, 'expected': page['elementor'], 'elementor': json.dumps(data, ensure_ascii=False, separators=(',', ':'))})

assert len(changes) >= 10
for page in changes:
    parsed = json.loads(page['elementor'])
    assert isinstance(parsed, list)
    if page['id'] in [12833, 12834, 12835, 12836, 12838]:
        assert '"ending_number":"422"' not in page['elementor']
    if page['id'] == 2113:
        assert 'elementskit-content-ticker' not in page['elementor']
    if page['id'] == 12844:
        assert '120+</strong>mașini electrice' not in page['elementor']
Path('evidence/updates.json').write_text(json.dumps(changes, ensure_ascii=False), encoding='utf-8')
print('Prepared page updates:', [p['id'] for p in changes])
