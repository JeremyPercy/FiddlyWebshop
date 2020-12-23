DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `user_data`;
DROP TABLE IF EXISTS `role`;
DROP TABLE IF EXISTS `order`;
DROP TABLE IF EXISTS `product_type`;
DROP TABLE IF EXISTS `product`;
DROP TABLE IF EXISTS `serialnumber`;
DROP TABLE IF EXISTS `fiddly_gps`;
DROP TABLE IF EXISTS `fiddly_gps_data`;
DROP TABLE IF EXISTS `order_quantity`;
DROP TABLE if EXISTS `contact_form`;
DROP TABLE if EXISTS `chat_form`;
DROP TABLE if EXISTS `translation`;
DROP TABLE if EXISTS `search_word`;


CREATE TABLE `role` (
  role_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  role_name TEXT NOT NULL

);


CREATE TABLE `user` (
  user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  user_image VARCHAR (255) DEFAULT 'usericon.svg',
  role_id_FK INT DEFAULT 2,

    FOREIGN KEY (role_id_FK) REFERENCES `role`(role_id)

  ON DELETE RESTRICT
  ON UPDATE CASCADE
);

CREATE TABLE `user_data` (
  user_data_id INT not null PRIMARY KEY AUTO_INCREMENT,
  address TEXT,
  zipcode VARCHAR(255),
  city VARCHAR(255),
  country TEXT,
  phone VARCHAR(255),
  date_of_birth DATE,
  user_id_FK INT NOT NULL,

    FOREIGN KEY (user_id_FK) REFERENCES `user`(user_id)
ON DELETE RESTRICT
ON UPDATE CASCADE

);

CREATE TABLE `order` (
  order_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  order_date DATE NOT NULL,
  payment_status VARCHAR(20),
  delivery_status VARCHAR(20),
  user_id_FK INT NOT NULL,

    FOREIGN KEY (user_id_FK) REFERENCES `user`(user_id)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
);



CREATE TABLE `product` (
  product_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name text NOT NULL,
  image_link VARCHAR (255) default'fiddly-product.png',
  description longtext NOT NULL,
  description_en longtext NOT NULL
);

CREATE TABLE `product_type` (
  product_type_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  type TEXT,
  pieces INT,
  price DECIMAL(6,2),
  quantity int(11) NOT NULL DEFAULT '1',
  product_id_FK INT NOT NULL,

    FOREIGN KEY (product_id_FK) REFERENCES `product`(product_id)
  ON DELETE RESTRICT
  ON UPDATE CASCADE
);

CREATE TABLE `serialnumber` (
  serialnumber_id  INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  number INT,
  date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  order_id_FK INT NOT NULL,

      FOREIGN KEY (order_id_FK) REFERENCES `order`(order_id)
      ON DELETE RESTRICT
    ON UPDATE CASCADE
);


CREATE TABLE `fiddly_gps` (
  fiddly_gps_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name TEXT,
  activation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  image_link VARCHAR (255),
  user_id_FK INT NOT NULL,
  serialnumber_id_FK INT NOT NULL,

    FOREIGN KEY (user_id_FK) REFERENCES `user`(user_id),
    FOREIGN KEY (serialnumber_id_FK) REFERENCES `serialnumber`(serialnumber_id)
  ON DELETE RESTRICT
  ON UPDATE CASCADE
);

CREATE TABLE `fiddly_gps_data` (
  fiddly_gps_data_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  longitude VARCHAR(12) NOT NULL,
  lattitude VARCHAR(12) NOT NULL,
  battery_status INT NOT NULL,
  fiddly_gps_id_FK INT NOT NULL,


    FOREIGN KEY (fiddly_gps_id_FK) REFERENCES `fiddly_gps`(fiddly_gps_id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
);

CREATE TABLE `translation` (
  `translation_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL DEFAULT '',
  `value_nl` text,
  `value_en` text,
  PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

CREATE TABLE `search_word` (
  `search_word_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(100) NOT NULL DEFAULT '',
  `description` text,
  `description_en` text,
  `link` varchar(100) DEFAULT '',
  `count` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`search_word_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

CREATE TABLE `chat_form` (
  chat_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255),
  issue VARCHAR(255),
  message VARCHAR(255)
);

CREATE TABLE `contact_form` (
  contact_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255),
  name VARCHAR(255),
  subject VARCHAR(255),
  message VARCHAR(255)
);

#koppeltabel tussen de orders en de bestelde producten
CREATE TABLE `order_quantity` (
  order_quantity_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  order_id_FK INT NOT NULL,
  product_type_id_FK INT NOT NULL,
  quantity INT NOT NULL,

    FOREIGN KEY (order_id_FK) REFERENCES `order`(order_id),
    FOREIGN KEY (product_type_id_FK) REFERENCES `product_type`(product_type_id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
);

INSERT INTO `translation` ( `key`, `value_nl`, `value_en`)
VALUES
	('searchPlaceholder', 'Zoeken...', 'Search..'),
	('order-today', 'Bestel vandaag', 'Order today'),
	('about-us', 'over ons', 'about us'),
	('feature', 'feature', 'feature'),
	('features', 'features', 'features'),
	('features-text-1', 'Steeds beschikbaar dankzij onze webapp', 'Online access thanks to our web-app'),
	('features-title-2', 'Extreem beveiligd', 'Extremely safe'),
	('features-text-2', 'Jouw privacy is onze zorg', 'We care about your privacy'),
	('features-title-3', 'Vind je locatie', 'Find location'),
	('learn-more', 'Meer weten', 'Learn more'),
	('features-title-1', 'Steeds toegankelijk', 'Always accessible '),
	('download-our-app', 'Download onze app', 'Download our app'),
	('download-our-app-text', 'Fiddly GPS is een GPS tracker dat gemaakt is om bijv. je spullen te volgen. Via onze gebruikerslogin kan je inloggen op jouw unieke pagina waarbij je jouw fiddly kan registreren', 'Fiddly GPS is a GPS tracker that is made to track your things, for example. Through our user login you can log in on your unique page where you can register your fiddly'),
	('chat-with-us', 'Chat met ons', 'Chat with us'),
	('contact-us', 'Neem contact op', 'Contact us'),
	('email', 'E-mail', 'Email'),
	('issue', 'Issue', 'Issue'),
	('submit', 'Versturen', 'Submit'),
	('chat-with-us-comment', 'Opmerkingen', 'Place here your comment'),
	('nav-home', 'Home', 'Home'),
	('nav-about', 'Over ons', 'About'),
	('nav-shop', 'Winkel', 'Shop'),
	('nav-contact', 'Contact', 'Contact'),
	('welcome', 'Welkom', 'Welcome'),
	('nav-dashboard', 'Dashboard', 'Dashboard'),
	('nav-profile', 'Profiel', 'Profile'),
	('nav-logout', 'Uitloggen', 'Logout'),
	('en', 'EN', 'EN'),
	('nl', 'NL', 'NL'),
	('login-register', 'Inloggen / registreren', 'Login / register'),
	('cart-total', 'Er zitten {count} items in uw winkelwagen', 'There are {count} items in your cart'),
	('watch-them-here', 'Bekijk ze hier', 'watch them here'),
	('go-to-shop', 'Ga naar de shop', 'Go to the shop'),
	('add-product', 'Product toevoegen', 'Add product'),
	('product-name', 'Product naam', 'Product name'),
	('product-description', 'Product beschrijving', 'Product description'),
	('product-description_en', 'Product beschrijving (Engels)', 'Product description (English)'),
	('add-product-type', 'Voeg product type toe', 'Add product type'),
	('product-type-type', 'Type', 'Type'),
	('product-type-pieces', 'Hoeveelheid', 'Pieces'),
	('product-type-price', 'Prijs', 'Price'),
	('select-product', 'Selecteer product', 'Select product'),
	('nav-admin', 'Admin', 'Admin'),
	('dashboard-fiddly-registered', 'Fiddly\'s geregistreerd', 'Fiddly\'s registered'),
	('dashboard-users-registered', 'Gebruikers geregistreerd', 'Users registered'),
	('dashboard-total-orders', 'Aantal bestellingen', 'Total orders'),
	('get-started', 'Get started', 'Get started'),
	('no-fiddly-registered', 'Je hebt nog geen Fiddly geregistreerd..', 'You have not yet registered a Fiddly...'),
	('register-or-order', 'Registreer of bestel nu jouw unieke fiddly!', 'Register or order your unique fiddly now!'),
	('register-now', 'Nu registreren', 'Register now!'),
	('product-overview', 'Producten overzicht', 'Product overview'),
	('name', 'Naam', 'Name'),
	('description', 'Beschrijving', 'Description'),
	('edit', 'Aanpassen', 'Edit'),
	('remove', 'Verwijderen', 'Remove'),
	('add', 'Toevoegen', 'Add'),
	('change-product-types', 'Pas product types aan', 'Change product types'),
	('product-type-overview', 'Product type overzicht', 'Product type overview'),
	('product-type', 'Product type', 'Product type'),
	('searchwords', 'Zoekwoorden', 'Keywords'),
	('link', 'Url', 'Link'),
	('count', 'Aantal', 'Amount'),
	('all-product-also-looking-for', 'Klanten die dit item hebben bezocht, bezochten ook de volgende items', 'Customers who visited this item also visited the following items'),
	('from', 'Vanaf', 'From'),
	('out-of-stock', 'Dit product is helaas niet meer leverbaar!', 'This product is out of stock!'),
	('choose-package', 'Kies uw pakket', 'Choose your package'),
	('add-to-cart', 'Toevoegen aan winkelwagen', 'Add to cart'),
	('looking-for', 'U zocht naar', 'You searched for'),
	('no-search-results', 'Er zijn helaas geen resultaten gevonden voor deze zoekopdracht', 'Sorry, no results were found for this search'),
	('found-product', 'Er zijn {count} producten gevonden', '{Count} products have been found'),
	('found-product-single', 'Er is 1 product gevonden', '1 product have been found'),
	('found-searchwords-single', 'Er is 1 item gevonden', '1 item was found'),
	('found-searchwords', 'Er zijn {count} items gevonden', '{Count} items have been found'),
	('item-deleted', 'Het item is succesvol verwijderd', 'The item has been successfully removed'),
	('error-name', 'Naam is niet juist', 'Name is not correct'),
	('error-description', 'Beschrijving is niet juist', 'Description is not correct'),
	('error-description_en', 'Beschrijving (Engels) is niet juist', 'Description (English) is not correct'),
	('add-searchword', 'Zoekwoord toevoegen', 'Add keyword'),
	('searchword-edited', 'Zoekwoord aangepast', 'Keyword edited'),
	('add-fiddly', 'Voeg een Fiddly toe', 'Add Fiddly'),
	('choose-a-name', 'Kies een naam', 'Choose a name'),
	('serial-number', 'Serie nummer', 'Serial number'),
	('insert-serial', 'geef uw serie nummer op', 'Insert serial number'),
	('order-id', 'Bestellingsnummer', 'Order id'),
	('update-picture', 'Upload foto', 'upload picture'),
	('back', 'terug', 'back'),
	('insert-order-id', 'geef uw bestellingsnummer op', 'inster order id'),
	('link-internal', 'Link (alleen intern dus bijv. /pages/about)', 'Link (only internally for example. /pages/about)'),
  ('edit-profile', 'Profiel aanpassen', 'Edit Profile'),
  ('password', 'Wachtwoord', 'Password'),
  ('address', 'Adres', 'Address'),
  ('city', 'Stad', 'City'),
  ('zip', 'Postcode', 'Zip'),
  ('country', 'Land', 'Country'),
  ('phone', 'Telefoonnummer', 'Phone'),
  ('birthday', 'Geboortedatum', 'Birthday'),
  ('edit-shipping-details', 'Verzend gegevens bijwerken', 'Edit shipping details'),
	('back', 'terug', 'back'),
	('access-denied', 'Toegang geweigerd', 'Access denied'),
	('dashboard', 'Dashboard', 'Dashboard'),
	('profile', 'Profiel', 'Profile'),
	('fiddly', 'Fiddly\'s', 'Fiddly\'s'),
	('orders', 'Bestellingen', 'Orders'),
	('admin', 'Admin', 'Admin'),
	('upload-csv', 'Upload csv', 'Upload csv'),
	('csv', NULL, NULL),
	('csv-success', 'CSV succesvol toegevoegd', 'Csv added succesfully'),
	('csv-error', 'Er is iets fout gegaan', 'Something went wrong'),
  ('use-this-csv', 'Maak gebruik van deze csv', 'Make use of this csv'),
  ('edit-profile-account-successful', 'Profiel is bijgewerkt', 'Profile is updated successfully'),
  ('edit-profile-shipping-edit-successful', 'Verzend adress is bijgewerkt', 'Shipping address is updated'),
  ('edit-profile-password-err', 'Foutieve wachtwoord, maak gebruik van minimaal 6 karakters', 'Invalid password please use a minimum of 6 characters'),
  ('edit-profile-email-err', 'Email is al in gebruik', 'Email is already in use'),
  ('edit-profile-shipping-added-successful', 'Uw verzend gegevens zijn toegevoegd', 'Shipping details are now added to your account'),
  ('go-back-admin', 'Ga terug naar admin paneel', 'Go back to admin panel'),
  ('role', 'Rechten', 'Role'),
  ('update', 'Bijwerken', 'Update'),
  ('list-messages', 'Lijst met chat berichten', 'List with chat messages'),
  ('contact-messages', 'Lijst met contact berichten', 'List with contact messages'),
  ('message', 'Bericht', 'Message'),
  ('subject', 'Onderwerp', 'Subject'),
  ('delete', 'Verwijderen', 'Delete'),
  ('message', 'Bericht', 'Message'),
  ('find-fiddlys', "Zoek je Fiddly\'s", 'Find your Fiddly'),
  ('battery', 'Batterij status', 'Battery status'),
  ('route-to-fiddly', 'Routebeschrijving', 'Travel directions'),
  ('battery_status', 'Batterij Status', 'Battery Status'),
  ('overview', 'Overzicht', 'Overview'),
  ('location', 'Locatie', 'Location'),
  ('activation_date', 'Activatie datum', 'Activation date'),
  ('image', 'Afbeelding', 'Image'),
	('go-back-user', 'Ga terug naar gebruikerspaneel', 'Go back to user panel'),
	('description_en', 'Beschrijving (Engels)', 'Description (English)'),
  ('go-back-cart', 'Ga terug naar winkelwagentje', 'Return to shoppingcar'),
  ('shipping-details', 'Verzend gegevens', 'Shopping details'),
  ('go-back-order', 'Ga terug naar order', 'Return to order'),
  ('thank-you-for-order', 'Bedankt voor uw bestelling', 'Thank you for ordering'),
  ('order-successful', 'Bestelling succesvol afgerond, hieronder ontvangt u uw factuur samen met de registratie
                        codes.', 'Order confirmed. On your invoice you receive your Fiddly Serial numbers.'),
  ('QTY', 'Aantal', 'Quantity'),
  ('product', 'Product', 'Product'),
  ('type', 'Type', 'Type'),
  ('price', 'Prijs', 'Price'),
  ('total', 'Totaal', 'Total'),
  ('please-fill-in-shipping-details', 'Vul hier uw verzend gegevens in of pas deze aan', 'Please fill in your shipping details in order to continue'),
  ('products', 'Producten', 'Products'),
  ('confirm-order', 'Bevestig uw bestelling', 'Confirm order'),
  ('date', 'Datum', 'Date'),
  ('payment', 'Betaling', 'Payment'),
  ('delivery', 'Bezorging', 'Delivery'),
  ('view', 'Bekijk', 'View'),
  ('order_number', 'Bestelnummer', 'Ordernumber'),
  ('test-key', 'Deze vertaling klopt', 'This translation is correct'),
  ('Please_enter_name', 'Geef een naam op', 'Please enter name'),
  ('Please_enter_order_id','Vul een order id in ','Please enter order id'),
  ('Please_enter_serial','Geef uw serie nummer op','Please enter Serial number'),
  ('add_fiddly_gps','Fiddly Gps tracker toegevoegd','Fiddly gps tracker added'),
  ('something_wrong','Er is iets mis gegaan','Something went wrong'),
  ('unknown_serial','Serialnummer of order id is niet bekend','Unknown Serial'),
  ('fiddly_deleted','Fiddly verwijderd','Fiddly Deleted'),
  ('enter_name','Geef een product naam op','Please enter product name'),
  ('fiddly_edited','Fiddly aangepast','Fiddly Edited'),
  ('product_added','Product toegevoegd','Product is added'),
  ('product_edited','Product aangepast','Product edited'),
  ('product_deleted','Product verwijderd','Product deleted'),
  ('delete_product_types_first','Verwijder eerst de product types','Delete product types first'),
  ('please_enter_type','Geef een prodct type op','Please enter type'),
  ('please_enter_pieces','Geef aantal stukken op','Please enter pieces'),
  ('maximum_pieces','Het aantal is te hoog','We cant sell that many pieces'),
  ('please_enter_price','Voer een prijs in','Please enter price'),
  ('check_price','Controleer de prijs','Please check te price'),
  ('price_to_high','De prijs is te hoog','Price is way too high'),
  ('round_number','Vul een heel getal in','Please fill in a round number'),
  ('type_added','Type toegevoegd','Type is added'),
  ('productType_deleted','Product Type verwijderd','Product Type deleted'),
  ('userRole_updated','De gebruikers rol is aangepast','User role is successfully updated'),
  ('shopping-cart-empty', 'Je winkelwagen is leeg', 'Shoppingcart is empty'),
  ('fiddly-gps-tracker', 'Fiddly GPS Tracker', 'Fiddly GPS Tracker'),
  ('out-of-sight', 'Uit het oog is uit het hart', 'Out of sight, out of mind'),
  ('home-description', 'Verlies nooit nog iets uit het oog dankzij onze Fiddly GPS-tracker. Bewonder het minimalistisch design ter grootte van een euromunt en de koppeling aan onze intuïtieve web-applicatie.', 'Never loses anything thanks to our Fiddly GPS-Tracker. Admire its minimalistic design with the size of a Euro coin and enjoy the connectivity to our intuitive webbased application.'),
  ('what-we-do', 'Wat wij doen', 'What we do'),
  ('about-us-description', 'Fiddly vindt haar oorsprong als een spin-off van de opleiding software ingenieur aan de Avans Hogeschool te Breda. Vier ondernemingsgezinde jonge mannen Jeremy Batten, Maarten Ceyssens, Martijn Dijkgraaf en Yoshua Weijl zijn de bezielers van dit project. Hun verschillende achtergrond en ervaring bleek een goede aanvulling te zijn en lag aan de basis voor dit ongezien succesverhaal in de GPS tracker industrie.',
   'Fiddly originated as a spin-off of the education to software engineers at the Avans University of Applied Sciences of Breda, the Netherlands. Four business-minded young men Jeremy Batten, Maarten Ceyssens, Martijn Dijkgraaf and Yoshua Weijl are the soul of this project. Their different background and experiences in early live seems to be the perfect combination for this unseen disruption in the GPS tracker industry.'),
  ('userRole_updated','De gebruikers rol is aangepast','User role is successfully updated'),
  ('form_succesful','Formulier succesvol','form succesful'),
  ('ordernumber','Bestellingsnummer: ','Ordernumber: '),
  ('fiddly_edited','Fiddly is aangepast: ','Fiddly is edited: '),
  ('checkout_shopping_cart','Afrekenen winkelwagentje','Checkout shopping cart'),
  ('form_error','Er is iets fout gegaan','something went wrong'),
  ('edit_product','Product aanpassen','Edit product '),
  ('product_name','Product Naam','Product Name'),
  ('Pieces','Aantal','Pieces'),
  ('Price','Prijs','Price'),
  ('Edit','Aanpassen','Edit'),
  ('Remove','Verwijderen','Remove'),
  ('form_not_correct','Eén of meerdere velden zijn niet correct ingevuld','One or more fields have not been filled in correctly'),
  ('shopping-cart-empty', 'Je winkelwagen is leeg', 'Shoppingcart is empty');


-- insert information tables

INSERT INTO role (role_name) VALUES ('admin'), ('user'), ('guest');

INSERT INTO `user` (`name`, `email`, `password`, `user_image`, `role_id_FK`)
VALUES
	('admin', 'admin@fiddly.nl', '$2y$10$e1bX8ddXXZpPFl8ZlF.vjuwGO5.4lWb1XrJQMgVXpRUFCGJ4cHiaO', 'usericon.svg', 1),
  ('user', 'user@fiddly.nl', '$2y$10$YlSjTpsLox3fccPJRY1aTuU52kEbwlGXjp1JGRgQOOAMy5Ic8Wh2a', 'usericon.svg', 2),
  ('Jeremy Batten',	'jeremy@pure-id.nl',	'$2y$10$mrgVWzwOMp4yPMSSMbURuenJT5F17mH5dL7/v2JO68trp8xDu3xq6', 'jeremy.jpg',	1),
  ('Yoshua Weijl',	'Yoshua@test.nl',	'$2y$10$WRdhLvER3rjL4pPdAfAZiupFgMgJ9cbeW5EkB1t1syepi/GqC4zYK', 'jeremy.jpg',	1),
	('Martijn Dijkgraaf', 'martijndijkgraaf96@gmail.com', '$2y$10$KuAEj5GlPxeDHFZwa/uXtuXSIttHKb0jmE3CYsrsIdTlLX55kCRIq', 'usericon.svg', 1);


INSERT INTO user_data (address, zipcode, city, country, phone, date_of_birth, user_id_FK)
VALUES
  ('Burgemeesterbrokxlaan',	'5041',	'tilburg', 'netherlands', '06123213231', '1987-09-23',	1),
  ('Burgemeesterbrokxlaan',	'5041',	'tilburg', 'netherlands', '06123213231', '1987-09-23',	3);


INSERT INTO product (`name`, `description`, `description_en`)
VALUES
  ('Fiddly GPS', 'Fiddly GPS is een GPS tracker dat gemaakt is om bijv. je spullen te volgen. Via onze gebruikerslogin kan je inloggen op jouw unieke pagina waarbij je jouw fiddly kan registreren', 'Fiddly GPS is a GPS tracker that is made to track your things, for example. Through our user login you can log in on your unique page where you can register your fiddly ' );



INSERT INTO product_type (type, pieces, price, quantity, product_id_FK)
VALUES
  ('1-pack', 1, 49.99, 1, 1),
  ('3-pack', 3, 129.99, 1, 1),
  ('5-pack', 5, 199.99, 1, 1);


