global $wpdb;
$translations = [
    'Specialiști dedicați' => 'Dedicated specialists',
    'Echipa noastră susține fiecare etapă a gestionării responsabile a deșeurilor.' => 'Our team supports every stage of responsible waste management.',
    'Colectare și sortare' => 'Collection and sorting',
    'Reciclare și valorificare' => 'Recycling and recovery',
    'Soluții adaptate fiecărui partener' => 'Solutions tailored to each partner',
    'Vehicule pentru colectare' => 'Collection vehicles',
    'Green Pack utilizează vehicule de diferite dimensiuni, adaptate colectării și transportului deșeurilor.' => 'Green Pack uses vehicles of different sizes, adapted to waste collection and transport.',
    'vehicule de colectare de toate dimensiunile' => 'collection vehicles of all sizes',
    'Linie de reciclare' => 'Recycling line',
    'Echipament de procesare' => 'Processing equipment',
    'Bandă transportoare' => 'Conveyor belt',
    'Instalație de procesare' => 'Processing installation',
    'Echipament de mărunțire' => 'Shredding equipment',
    'Linie de transport și procesare' => 'Conveying and processing line',
    'Instalație de reciclare' => 'Recycling installation',
    'Separator de materiale' => 'Material separator',
    'Transportul materialelor' => 'Material handling',
    'Linie de procesare a materialelor' => 'Material processing line',
    'Echipament industrial' => 'Industrial equipment',
    'Instalație de tratare' => 'Treatment installation',
    'Sistem de alimentare' => 'Feeding system',
    'Linie de extrudare' => 'Extrusion line',
    'Procesul de distrugere controlată — ilustrație' => 'Controlled destruction process — illustration',
    'Servicii profesionale de curățenie' => 'Professional cleaning services',
];
foreach ($translations as $original => $english) {
    if (strpos($original, 'Green Pack') === false && strpos($original, '—') === false) {
        $translations[$original . ' Green Pack'] = $english . ' Green Pack';
    }
}
$table = $wpdb->prefix . 'trp_dictionary_ro_ro_en_us';
$backup = [];
foreach ($translations as $original => $english) {
    $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$table` WHERE original=%s", $original), ARRAY_A);
    foreach ($rows as $row) $backup[] = $row;
}
$backupPath = '/home/u968429559/greenpack-backups/feedback-v3-20261106/translations-before.json';
if (file_exists($backupPath)) throw new Exception('Translation backup already exists');
if (file_put_contents($backupPath, wp_json_encode($backup)) === false) throw new Exception('Translation backup failed');
foreach ($translations as $original => $english) {
    $rows = $wpdb->get_col($wpdb->prepare("SELECT id FROM `$table` WHERE original=%s", $original));
    if ($rows) {
        foreach ($rows as $id) {
            if ($wpdb->update($table, ['translated'=>$english, 'status'=>1], ['id'=>$id]) === false) throw new Exception($wpdb->last_error);
        }
    } else {
        if (!$wpdb->insert($table, ['original'=>$original, 'translated'=>$english, 'status'=>1, 'block_type'=>0, 'original_id'=>0])) throw new Exception($wpdb->last_error);
    }
}
if (function_exists('wpfc_clear_all_cache')) wpfc_clear_all_cache();
echo 'Saved English translations: ' . count($translations) . "\n";
