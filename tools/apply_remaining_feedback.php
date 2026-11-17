// Back up the affected content, menu and translations before any mutation.
global $wpdb;
$backup_dir = '/home/u968429559/greenpack-backups/email-remaining-20261106';
if (is_dir($backup_dir)) throw new Exception('Backup already exists; inspect before rerunning');
if (!wp_mkdir_p($backup_dir)) throw new Exception('Cannot create backup directory');
$dictionary = $wpdb->prefix . 'trp_dictionary_ro_ro_en_us';
$snapshot = ['posts'=>[], 'meta'=>[], 'translations'=>$wpdb->get_results("SELECT * FROM `$dictionary`", ARRAY_A), 'page_for_posts'=>get_option('page_for_posts'), 'menu'=>wp_get_nav_menu_items('green-pack-main-menu')];
foreach ([680, 27, 12842] as $id) {
    $snapshot['posts'][$id] = get_post($id, ARRAY_A);
    $snapshot['meta'][$id] = get_post_meta($id);
}
$demo_ids = [1,44,46,48,50,52,54];
foreach ($demo_ids as $id) $snapshot['posts'][$id] = get_post($id, ARRAY_A);
if (get_page_by_path('autorizatii-certificari')) throw new Exception('Permits route already exists');
if (file_put_contents($backup_dir.'/before.json', wp_json_encode($snapshot)) === false) throw new Exception('Backup failed');

foreach ([680,12842] as $id) {
    $data = json_decode(get_post_meta($id, '_elementor_data', true), true, 512, JSON_THROW_ON_ERROR);
    $walk = function (&$elements) use (&$walk, $id) {
        foreach ($elements as &$e) {
            if ($id === 680 && $e['id'] === '4a70f53') $e['settings']['title'] = 'Așteptăm mesajul tău';
            if ($id === 680 && in_array($e['id'], ['9cb5d3d','248c01c'], true)) unset($e['settings']['custom_css']);
            if ($id === 12842 && isset($e['settings']['editor'])) $e['settings']['editor'] = str_replace('105.000 tone/an', '105.000+ tone/an', $e['settings']['editor']);
            if (!empty($e['elements'])) $walk($e['elements']);
        }
    };
    $walk($data);
    $json = wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    update_post_meta($id, '_elementor_data', wp_slash($json));
    if (get_post_meta($id, '_elementor_data', true) !== $json) throw new Exception('Save failed: '.$id);
    delete_post_meta($id, '_elementor_element_cache');
    if ($id === 12842) {
        $result = wp_update_post(['ID'=>$id,'post_content'=>str_replace('105.000 tone/an','105.000+ tone/an',get_post_field('post_content',$id))],true);
        if (is_wp_error($result)) throw new Exception($result->get_error_message());
    }
}

$news = <<<'HTML'
<div class="gp-information-page">
<p>Descoperă activitatea Green Pack și soluțiile noastre pentru economia circulară. Pentru informații de presă, materiale de prezentare sau detalii despre serviciile noastre, contactează echipa Green Pack.</p>
<section aria-labelledby="gp-media-title"><h2 id="gp-media-title">Green Pack în imagini</h2><video controls preload="metadata" playsinline poster="/wp-content/uploads/2026/09/gpk-video-poster.jpg" aria-label="Prezentare Green Pack"><source src="/wp-content/uploads/2026/09/GPK_v2.5.mp4" type="video/mp4">Browserul tău nu acceptă redarea video. <a href="/wp-content/uploads/2026/09/GPK_v2.5.mp4">Descarcă prezentarea Green Pack</a></video></section>
<section aria-labelledby="gp-activity-title"><h2 id="gp-activity-title">Explorează activitatea noastră</h2><div class="gp-info-grid">
<article class="gp-info-card"><h3>Colectare și gestionare</h3><p>Soluții adaptate pentru colectarea și gestionarea responsabilă a deșeurilor.</p><a href="/servicii-colectare/">Vezi serviciile de colectare</a></article>
<article class="gp-info-card"><h3>Sortare și reciclare</h3><p>Procese și tehnologii care ajută materialele recuperabile să reintre în circuitul economic.</p><a href="/reciclare/">Descoperă reciclarea</a></article>
<article class="gp-info-card"><h3>Infrastructura Green Pack</h3><p>Descoperă instalațiile, echipamentele și prezența noastră națională.</p><a href="/instalatii-echipamente/">Vezi infrastructura</a></article>
</div></section>
<section><h2>Comunicate și solicitări media</h2><p>Comunicatele și noutățile Green Pack vor fi publicate în această secțiune. Pentru solicitări de presă și materiale de prezentare, ia legătura cu echipa noastră.</p><a class="gp-feedback-button" href="/contact-us/">Contactează-ne pentru informații media</a></section>
</div>
HTML;
update_option('page_for_posts', 0);
$result = wp_update_post(['ID'=>27,'post_title'=>'Noutăți și media','post_content'=>$news,'comment_status'=>'closed'],true);
if (is_wp_error($result)) throw new Exception($result->get_error_message());
// Preserve the supplied demo content as drafts rather than deleting it.
foreach ($demo_ids as $id) {
    $result = wp_update_post(['ID'=>$id,'post_status'=>'draft'],true);
    if (is_wp_error($result)) throw new Exception($result->get_error_message());
}

$permits = <<<'HTML'
<div class="gp-information-page">
<p>Pentru documentele relevante colaborării cu Green Pack, echipa noastră vă poate oferi informații despre autorizațiile și certificările aplicabile serviciului și punctului de lucru vizat.</p>
<section class="gp-info-card"><h2>Solicită documentele aplicabile</h2><p>Indică serviciul de care ai nevoie, punctul de lucru sau zona de operare și documentele solicitate. Echipa Green Pack îți va comunica informațiile și documentele disponibile pentru cererea ta.</p><a class="gp-feedback-button" href="/contact-us/">Solicită informații și documente</a></section>
<section><h2>Informații pentru parteneri</h2><p>Pentru a identifica documentele corespunzătoare, consultă serviciile și infrastructura noastră sau contactează-ne pentru detalii.</p><div class="gp-info-grid"><article class="gp-info-card"><h3>Servicii</h3><p>Colectare și gestionare responsabilă a deșeurilor.</p><a href="/servicii-colectare/">Servicii de colectare</a></article><article class="gp-info-card"><h3>Puncte de lucru</h3><p>Informații despre prezența națională Green Pack.</p><a href="/prezenta-nationala/">Prezență națională</a></article><article class="gp-info-card"><h3>Contact</h3><p>Discută cerințele documentare cu echipa noastră.</p><a href="/contact-us/">Contactează-ne</a></article></div></section>
</div>
HTML;
$permit_id = wp_insert_post(['post_type'=>'page','post_status'=>'publish','post_name'=>'autorizatii-certificari','post_title'=>'Autorizații și certificări','post_content'=>$permits,'comment_status'=>'closed'],true);
if (is_wp_error($permit_id)) throw new Exception($permit_id->get_error_message());
file_put_contents($backup_dir.'/created-page-id.txt', (string)$permit_id);
$menu = wp_get_nav_menu_object('green-pack-main-menu');
$parent = 0;
foreach (wp_get_nav_menu_items($menu->term_id) as $item) if (mb_strtoupper($item->title) === 'INFRASTRUCTURĂ') $parent = $item->ID;
if (!$parent) throw new Exception('Infrastructure menu missing');
$menu_id = wp_update_nav_menu_item($menu->term_id,0,['menu-item-title'=>'Autorizații și certificări','menu-item-object-id'=>$permit_id,'menu-item-object'=>'page','menu-item-type'=>'post_type','menu-item-parent-id'=>$parent,'menu-item-status'=>'publish']);
if (is_wp_error($menu_id)) throw new Exception($menu_id->get_error_message());
file_put_contents($backup_dir.'/created-menu-id.txt', (string)$menu_id);

$translations = [
    'Acasă'=>'Home',
    'Noutăți și media'=>'News & Media',
    'Autorizații și certificări'=>'Permits & Certifications',
    'Infrastructură'=>'Infrastructure',
    '105.000+ tone/an'=>'105,000+ tonnes/year',
    'Așteptăm mesajul tău'=>'We look forward to your message',
    'Manager Operațional'=>'Operations Manager',
    'Economie circulară'=>'Circular economy',
    'Descoperă activitatea Green Pack și soluțiile noastre pentru economia circulară. Pentru informații de presă, materiale de prezentare sau detalii despre serviciile noastre, contactează echipa Green Pack.'=>'Discover Green Pack and our solutions for the circular economy. For press enquiries, presentation materials or details about our services, contact the Green Pack team.',
    'Green Pack în imagini'=>'Green Pack in pictures',
    'Prezentare Green Pack'=>'Green Pack presentation',
    'Browserul tău nu acceptă redarea video.'=>'Your browser does not support video playback.',
    'Descarcă prezentarea Green Pack'=>'Download the Green Pack presentation',
    'Explorează activitatea noastră'=>'Explore our work',
    'Colectare și gestionare'=>'Collection and management',
    'Soluții adaptate pentru colectarea și gestionarea responsabilă a deșeurilor.'=>'Tailored solutions for responsible waste collection and management.',
    'Vezi serviciile de colectare'=>'View collection services',
    'Sortare și reciclare'=>'Sorting and recycling',
    'Procese și tehnologii care ajută materialele recuperabile să reintre în circuitul economic.'=>'Processes and technologies that help recoverable materials return to the economy.',
    'Descoperă reciclarea'=>'Explore recycling',
    'Infrastructura Green Pack'=>'Green Pack infrastructure',
    'Descoperă instalațiile, echipamentele și prezența noastră națională.'=>'Discover our facilities, equipment and national presence.',
    'Vezi infrastructura'=>'View infrastructure',
    'Comunicate și solicitări media'=>'Announcements and media enquiries',
    'Comunicatele și noutățile Green Pack vor fi publicate în această secțiune. Pentru solicitări de presă și materiale de prezentare, ia legătura cu echipa noastră.'=>'Green Pack announcements and news will be published in this section. For press enquiries and presentation materials, contact our team.',
    'Contactează-ne pentru informații media'=>'Contact us for media information',
    'Pentru documentele relevante colaborării cu Green Pack, echipa noastră vă poate oferi informații despre autorizațiile și certificările aplicabile serviciului și punctului de lucru vizat.'=>'For documents relevant to working with Green Pack, our team can provide information about the permits and certifications applicable to the service and operating location concerned.',
    'Solicită documentele aplicabile'=>'Request the applicable documents',
    'Indică serviciul de care ai nevoie, punctul de lucru sau zona de operare și documentele solicitate. Echipa Green Pack îți va comunica informațiile și documentele disponibile pentru cererea ta.'=>'Specify the service you need, the operating location or area, and the documents requested. The Green Pack team will share the information and documents available for your enquiry.',
    'Solicită informații și documente'=>'Request information and documents',
    'Informații pentru parteneri'=>'Information for partners',
    'Pentru a identifica documentele corespunzătoare, consultă serviciile și infrastructura noastră sau contactează-ne pentru detalii.'=>'To identify the relevant documents, explore our services and infrastructure or contact us for details.',
    'Colectare și gestionare responsabilă a deșeurilor.'=>'Responsible waste collection and management.',
    'Servicii de colectare'=>'Collection services',
    'Puncte de lucru'=>'Operating locations',
    'Informații despre prezența națională Green Pack.'=>'Information about Green Pack’s national presence.',
    'Discută cerințele documentare cu echipa noastră.'=>'Discuss your document requirements with our team.',
];
$home = json_decode(get_post_meta(680,'_elementor_data',true),true);
$find_reviews = function ($elements) use (&$find_reviews, &$translations) {
    foreach ($elements as $e) {
        if ($e['id'] === 'c429243') {
            $english = ['"The services provided were fast, efficient and reliable. The team demonstrated professionalism at every stage, and their waste management solutions helped us actively protect the environment."','"Every partnership makes a valuable contribution to building a cleaner, greener and more prosperous future."'];
            foreach ($e['settings']['ekit_testimonial_data'] as $i=>$item) $translations[$item['review']] = $english[$i];
        }
        if (!empty($e['elements'])) $find_reviews($e['elements']);
    }
};
$find_reviews($home);
foreach ($translations as $original=>$english) {
    $ids = $wpdb->get_col($wpdb->prepare("SELECT id FROM `$dictionary` WHERE original=%s",$original));
    if ($ids) {
        foreach ($ids as $id) if ($wpdb->update($dictionary,['translated'=>$english,'status'=>1],['id'=>$id]) === false) throw new Exception($wpdb->last_error);
    } elseif (!$wpdb->insert($dictionary,['original'=>$original,'translated'=>$english,'status'=>1,'block_type'=>0,'original_id'=>0])) throw new Exception($wpdb->last_error);
}
if (class_exists('Elementor\\Plugin')) \Elementor\Plugin::$instance->files_manager->clear_cache();
if (function_exists('wpfc_clear_all_cache')) wpfc_clear_all_cache();
echo wp_json_encode(['permits_page'=>$permit_id,'menu_item'=>$menu_id,'demo_posts_drafted'=>$demo_ids,'translations'=>count($translations),'backup'=>$backup_dir]);
