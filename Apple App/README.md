# Custom Campaign Frame Generator - WordPress Plugin

This is a comprehensive WordPress plugin that allows users to overlay custom frames on photos with form data, integrating with Google Sheets and Drive.

## Plugin Structure

```
Apple App/
├── campaign-frame-generator.php (Main plugin file)
├── includes/
│   ├── class-database.php (Database operations)
│   ├── class-campaign.php (Campaign management)
│   ├── class-google-integration.php (Google Sheets & Drive integration)
│   ├── class-shortcode.php (Shortcode handler)
│   └── class-ajax.php (AJAX operations)
├── admin/
│   ├── class-admin.php (Admin interface)
│   ├── views/
│   │   ├── campaigns-list.php (Campaign list view)
│   │   ├── campaign-edit.php (Campaign edit view)
│   │   └── settings.php (Settings page)
│   ├── css/
│   │   └── admin-styles.css (Admin styles)
│   └── js/
│       ├── admin-scripts.js (Admin scripts)
│       └── form-builder.js (Form builder functionality)
├── public/
│   ├── class-public.php (Public facing functionality)
│   ├── views/
│   │   └── campaign-display.php (Campaign display)
│   ├── css/
│   │   └── public-styles.css (Public styles)
│   └── js/
│       ├── canvas-handler.js (Canvas manipulation)
│       └── form-handler.js (Form handling)
└── assets/
    └── images/ (Plugin images)
```

## Features

- **Campaign Management**: Create and manage multiple campaigns
- **Custom Frame Overlay**: Upload transparent PNG frames to overlay on user photos
- **Dynamic Form Builder**: Create custom forms with various field types
- **Text Overlays**: Add dynamic text overlays on images based on form data
- **Image Manipulation**: Zoom, rotate, and position user photos
- **Google Integration**: Sync submissions to Google Sheets and upload images to Google Drive
- **Responsive Design**: Mobile-friendly canvas and form interface
- **Shortcode Support**: Easy embedding with `[campaign_frame id="X"]`

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to Frame Generator > Settings to configure Google integration (optional)
4. Create your first campaign and start generating custom frames!

## Usage

1. Create a campaign with your custom frame image
2. Design your form fields
3. Configure text overlays
4. Use the shortcode `[campaign_frame id="X"]` on any page
5. Users can upload photos and generate custom framed images

## Version

1.0.0 - Initial Release

## Author

Developed for custom campaign frame generation needs.

## License

GPL v2 or later
