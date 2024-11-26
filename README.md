
# **Device-Specific Homepage Plugin for WordPress**

## **Description**  
A custom WordPress plugin that dynamically assigns and displays different homepages based on the user's device type (mobile, tablet, or desktop). This plugin enhances user experience by providing optimized layouts tailored for each device type.

---

## **Features**
- Admin panel to assign specific homepages for:
  - Mobile
  - Tablet
  - Desktop
- Device detection powered by `Mobile_Detect` library.
- Seamless redirection to device-specific homepages.
- Performance-optimized with caching support.
- Fallback options if a specific homepage isn't assigned for a device.
- Simple toggle to enable or disable the functionality.

---

## **Installation**

1. **Download or Clone the Plugin**  
   Clone this repository or download it as a ZIP file:
   ```bash
   git clone https://github.com/mohamedyussry/devices-specific-homepage-plugin-wordpress.git
   ```

2. **Upload the Plugin**  
   - Upload the plugin folder `devices-specific-homepage-plugin-wordpress` to the `wp-content/plugins/` directory.

3. **Activate the Plugin**  
   - Go to **WordPress Admin Dashboard** > **Plugins** > **Installed Plugins**.
   - Find "Device-Specific Homepage" and click **Activate**.

4. **Set Up Device-Specific Homepages**  
   - Navigate to **Settings** > **Homepage Switcher**.
   - Assign a homepage for each device type (mobile, tablet, desktop) and save your settings.

---

## **Requirements**
- WordPress 5.0 or later.
- PHP 7.2 or later.
- `Mobile_Detect.php` library included in the plugin.

---

## **How It Works**
1. The plugin uses the `Mobile_Detect` library to determine the device type (mobile, tablet, desktop).
2. Based on the detected device type, the plugin redirects the user to the corresponding homepage configured in the admin panel.
3. If no homepage is set for a specific device type, it defaults to the standard WordPress homepage.

---

## **License**
This plugin is licensed under the GPLv2 or later license. See the `LICENSE` file for more details.

---

## **Support**
For issues or feature requests, please open an issue in the [GitHub repository](https://github.com/mohamedyussry/devices-specific-homepage-plugin-wordpress/issues).

---

### **Thank you for using Device-Specific Homepage Plugin!**  
