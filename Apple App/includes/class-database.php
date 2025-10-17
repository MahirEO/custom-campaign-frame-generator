<?php

class CFG_Database {
    
    public static function create_tables() {
        global $wpdb;
        
        $charset_collate = $wpdb->get_charset_collate();
        
        // Campaigns table
        $campaigns_table = $wpdb->prefix . 'cfg_campaigns';
        $sql_campaigns = "CREATE TABLE $campaigns_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            campaign_title varchar(255) NOT NULL,
            campaign_slug varchar(255) NOT NULL,
            description text,
            frame_image_id int(11),
            background_type enum('color','image') DEFAULT 'color',
            background_value varchar(255),
            form_fields longtext,
            text_overlays longtext,
            visibility enum('public','private') DEFAULT 'public',
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY campaign_slug (campaign_slug)
        ) $charset_collate;";
        
        // Submissions table
        $submissions_table = $wpdb->prefix . 'cfg_submissions';
        $sql_submissions = "CREATE TABLE $submissions_table (
            id int(11) NOT NULL AUTO_INCREMENT,
            campaign_id int(11) NOT NULL,
            form_data longtext,
            image_url varchar(500),
            google_drive_url varchar(500),
            google_sheet_row int(11),
            user_ip varchar(45),
            created_at datetime DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY campaign_id (campaign_id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql_campaigns);
        dbDelta($sql_submissions);
    }
    
    public static function get_campaigns() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cfg_campaigns';
        return $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");
    }
    
    public static function get_campaign($id) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cfg_campaigns';
        return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));
    }
    
    public static function get_campaign_by_slug($slug) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cfg_campaigns';
        return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE campaign_slug = %s", $slug));
    }
    
    public static function save_campaign($data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cfg_campaigns';
        
        if (isset($data['id']) && $data['id']) {
            // Update existing
            $wpdb->update(
                $table_name,
                $data,
                array('id' => $data['id'])
            );
            return $data['id'];
        } else {
            // Insert new
            unset($data['id']);
            $wpdb->insert($table_name, $data);
            return $wpdb->insert_id;
        }
    }
    
    public static function delete_campaign($id) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cfg_campaigns';
        return $wpdb->delete($table_name, array('id' => $id));
    }
    
    public static function save_submission($data) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'cfg_submissions';
        $wpdb->insert($table_name, $data);
        return $wpdb->insert_id;
    }
}
