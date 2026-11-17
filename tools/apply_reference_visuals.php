$backup = '/home/u968429559/greenpack-backups/reference-visuals-20261106-090213';
$before = json_decode(file_get_contents($backup . '/before-visuals.json'), true, 512, JSON_THROW_ON_ERROR);
foreach ($before as $page) {
    if (get_post_meta($page['id'], '_elementor_data', true) !== $page['elementor']) {
        throw new Exception('Concurrent editor change on page ' . $page['id']);
    }
}
require_once ABSPATH . 'wp-admin/includes/image.php';
$directory = WP_CONTENT_DIR . '/uploads/2026/11/greenpack-v3-reference/';
$visuals = [
    12833 => ['waste-management', 'Managementul deșeurilor — vizual ilustrativ', 'Waste management — illustrative visual'],
    12834 => ['sorting', 'Sortarea automată a deșeurilor — vizual ilustrativ', 'Automated waste sorting — illustrative visual'],
    12835 => ['recycling', 'Fulgi de plastic reciclat — vizual ilustrativ', 'Recycled plastic flakes — illustrative visual'],
    12836 => ['controlled-destruction', 'Manipularea produselor pentru distrugere controlată — vizual ilustrativ', 'Handling goods for controlled destruction — illustrative visual'],
    12838 => ['cleaning', 'Curățenie profesională a pardoselilor — vizual ilustrativ', 'Professional floor cleaning — illustrative visual'],
];
$attachments = [];
if (is_file($backup . '/attachments.json')) throw new Exception('These visuals have already been registered');
foreach ($visuals as $visual) {
    $file = $directory . $visual[0] . '.webp';
    if (!is_file($file) || !getimagesize($file)) throw new Exception('Invalid asset ' . $visual[0]);
}
foreach ($visuals as $pageId => $visual) {
    [$name, $romanian, $english] = $visual;
    $file = $directory . $name . '.webp';
    if (!is_file($file) || !getimagesize($file)) throw new Exception('Invalid asset ' . $name);
    $id = wp_insert_attachment([
        'post_title' => $name . ' — reference-based marketing visual',
        'post_content' => 'AI-generated marketing visual based on the user-supplied Example_visuals_website pages.png. Not a documentary photograph of a specific Green Pack facility.',
        'post_mime_type' => 'image/webp',
        'post_status' => 'inherit',
    ], $file, 0, true);
    if (is_wp_error($id)) throw new Exception($id->get_error_message());
    update_post_meta($id, '_wp_attachment_image_alt', $romanian);
    update_post_meta($id, '_greenpack_reference_alt_en', $english);
    wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $file));
    $attachments[$pageId] = ['id'=>$id, 'url'=>wp_get_attachment_url($id), 'alt'=>$romanian, 'english'=>$english];
}
file_put_contents($backup . '/attachments.json', wp_json_encode($attachments, JSON_PRETTY_PRINT));
foreach ($before as $page) {
    if (!isset($attachments[$page['id']])) continue;
    $asset = $attachments[$page['id']];
    $data = json_decode($page['elementor'], true, 512, JSON_THROW_ON_ERROR);
    $walk = function (&$elements) use (&$walk, $asset, $page) {
        foreach ($elements as &$widget) {
            $settings = &$widget['settings'];
            $id = $widget['id'];
            if ($id === '8881760') {
                $settings['background_image'] = ['url'=>$asset['url'], 'id'=>$asset['id'], 'size'=>'full', 'alt'=>$asset['alt'], 'source'=>'library'];
            }
            $imageIds = ['2c1dc93'];
            if (in_array($page['id'], [12833, 12836], true)) $imageIds[] = '899f68b';
            if ($page['id'] === 12838) $imageIds = ['2c1dc93', '899f68b', '66a2a61'];
            if (in_array($id, $imageIds, true)) {
                $settings['image'] = ['url'=>$asset['url'], 'id'=>$asset['id'], 'size'=>'full', 'alt'=>$asset['alt'], 'source'=>'library'];
            }
            if (!empty($widget['elements'])) $walk($widget['elements']);
        }
    };
    $walk($data);
    $encoded = wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    update_post_meta($page['id'], '_elementor_data', wp_slash($encoded));
    if (get_post_meta($page['id'], '_elementor_data', true) !== $encoded) throw new Exception('Save failed on page ' . $page['id']);
    delete_post_meta($page['id'], '_elementor_element_cache');
    \Elementor\Core\Files\CSS\Post::create($page['id'])->update();
    echo 'Updated reference visual on page ' . $page['id'] . "\n";
}
global $wpdb;
$table = $wpdb->prefix . 'trp_dictionary_ro_ro_en_us';
foreach ($attachments as $asset) {
    $ids = $wpdb->get_col($wpdb->prepare("SELECT id FROM `$table` WHERE original=%s", $asset['alt']));
    if ($ids) {
        foreach ($ids as $id) $wpdb->update($table, ['translated'=>$asset['english'], 'status'=>1], ['id'=>$id]);
    } else {
        $wpdb->insert($table, ['original'=>$asset['alt'], 'translated'=>$asset['english'], 'status'=>1, 'block_type'=>0, 'original_id'=>0]);
    }
    if ($wpdb->last_error) throw new Exception($wpdb->last_error);
}
if (function_exists('wpfc_clear_all_cache')) wpfc_clear_all_cache();
echo wp_json_encode($attachments);
