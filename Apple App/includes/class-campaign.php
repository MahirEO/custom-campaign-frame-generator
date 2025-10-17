<?php

class CFG_Campaign {
    
    private $id;
    private $data;
    
    public function __construct($id = null) {
        if ($id) {
            $this->id = $id;
            $this->load();
        }
    }
    
    public function load() {
        $this->data = CFG_Database::get_campaign($this->id);
        if ($this->data) {
            $this->data->form_fields = json_decode($this->data->form_fields, true);
            $this->data->text_overlays = json_decode($this->data->text_overlays, true);
        }
    }
    
    public function get_frame_url() {
        if ($this->data && $this->data->frame_image_id) {
            return wp_get_attachment_url($this->data->frame_image_id);
        }
        return '';
    }
    
    public function get_form_fields() {
        return $this->data->form_fields ?: array();
    }
    
    public function get_text_overlays() {
        return $this->data->text_overlays ?: array();
    }
    
    public function render_form() {
        $fields = $this->get_form_fields();
        $html = '<div class="cfg-form">';
        
        foreach ($fields as $field) {
            $html .= '<div class="cfg-form-group">';
            $html .= '<label>' . esc_html($field['label']) . '</label>';
            
            switch ($field['type']) {
                case 'text':
                case 'email':
                    $html .= '<input type="' . $field['type'] . '" 
                        id="' . esc_attr($field['id']) . '"
                        name="' . esc_attr($field['id']) . '"
                        placeholder="' . esc_attr($field['placeholder']) . '"
                        ' . ($field['required'] ? 'required' : '') . '>';
                    break;
                
                case 'select':
                    $html .= '<select id="' . esc_attr($field['id']) . '" name="' . esc_attr($field['id']) . '" ' . ($field['required'] ? 'required' : '') . '>';
                    foreach ($field['options'] as $option) {
                        $html .= '<option value="' . esc_attr($option) . '">' . esc_html($option) . '</option>';
                    }
                    $html .= '</select>';
                    break;
                
                case 'textarea':
                    $html .= '<textarea id="' . esc_attr($field['id']) . '" name="' . esc_attr($field['id']) . '" placeholder="' . esc_attr($field['placeholder']) . '" ' . ($field['required'] ? 'required' : '') . '></textarea>';
                    break;
            }
            
            $html .= '</div>';
        }
        
        $html .= '<div class="cfg-form-group">';
        $html .= '<label>Upload Your Photo</label>';
        $html .= '<input type="file" id="cfg-image-upload" accept="image/jpeg,image/png" required>';
        $html .= '</div>';
        
        $html .= '<button type="submit" class="cfg-submit-btn">Generate Image</button>';
        $html .= '</div>';
        
        return $html;
    }
}
