# WP Starter based on Bootstrap 4, Advanced Custom Fields and Gravity Forms

## Getting Started
1. First you will need to log in to Bitbucket to grab the `wp_starter` starter repo.
2. Go here:  <https://bitbucket.org/tayloe-gray/wp_starter/src/master/>
3. In the repo, click the `Clone` button at the top, then click the `Copy` button to copy the git action to your clipboard.
1. `cd` into your working directory.
2. Now run your git action to clone the repo locally. It will look something like: ```git clone https://jnarciso@bitbucket.org/tayloe-gray/wp_starter.git```.
2. Install Node Packages: run the following in terminal `npm install`.
3. Run Gulp: `gulp`.

### Gulp Usage
* To watch SASS and JS and generate compressed files, run `gulp`.

### Real Favicon Generator
* Run `npm install gulp-real-favicon --save-dev` to install the node module.
* Make sure you have a file called `favicon.png` inside `/includes/images/`. This is what the script will generate your favicon image from.
* Next, run `gulp generate-favicon` to create icons. (Make sure your paths and settings are in place, as needed.)
* Images will be saved to `/includes/images/device-icons`.

### Site Info
* Custom theme info is now setup using ACF.
* This will give you the options/fields to add specific info about your site like phone numbers, address, social URLs, etc.
* The PHP variables to output data are already setup in key places like `header.php`, `footer.php` and `page-contact.php`. 
* They are fully editable from the ACF Field Groups menu and you can change/add/remove as your theme requires.
* Add and activate the ACF Pro plugin on your site and then import this file from your theme repo: `acf-export-site-info.json`.
* (In wp-admin, go to Custom Fields > Tools > Import Field Groups).
* (Note: if you don't add the import file but have the plugin installed, you will see errors on the front end or your site may seem "broken" - depending on if you have wp-debug turned on in Flywheel on the site instance).
* Now all fields are available in the sidebar under the Site Info option.

### Ususal Required Plugins
* Advanced Custom Fields Pro (will need license key) : <https://www.advancedcustomfields.com/>
* Custom Post Type UI : <https://wordpress.org/plugins/custom-post-type-ui/>
* Gravity Forms (will need license key) : <https://www.gravityforms.com/>
* Wordpress SEO (Yoast) : <https://wordpress.org/plugins/wordpress-seo/>
* Simple Custom Post Order (not required but nice to have/comes in handy) : <https://wordpress.org/plugins/simple-custom-post-order/>

### Project Dependencies 
* Node Package Manager : <https://www.npmjs.com/>
* Gulp : <https://gulpjs.com/>
* SASS : <https://sass-lang.com/>

### Responsive Framework
* Bootstrap 4 : <https://getbootstrap.com/>

### Custom Fields Info/Usage/Setup
* Advanced Custom Fields : <https://www.advancedcustomfields.com/resources/>

### Our Basic Working Toolkit
* Sublime Text : <https://www.sublimetext.com/>
* Sketch : <https://www.sketchapp.com/>
* WBond SFTP : <https://wbond.net/sublime_packages/sftp>
* Terminal : Included on your mac

