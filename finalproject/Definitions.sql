-- GEOFFREY PARD
-- CS 340 - 400
-- Final Project

-- -----------------------------------------------------------------------------
--                  TABLE CREATION
-- This portion provides the definitions for table creation in the database.
-- -----------------------------------------------------------------------------

-- FOOD TYPE
CREATE TABLE food_type (
	id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	PRIMARY KEY (id)
)ENGINE=InnoDB;

-- CUISINE TYPE
CREATE TABLE cuisine_type (
	id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255) NOT NULL,
	PRIMARY KEY (id)
)ENGINE=InnoDB;

-- FOOD INVENTORY
CREATE TABLE food_inventory (
	foodID int(11) NOT NULL AUTO_INCREMENT,
	ftype int(11) NOT NULL,
	name varchar(255),
	FOREIGN KEY (ftype) REFERENCES food_type (id),
	PRIMARY KEY (foodID),
	UNIQUE KEY (name)
)ENGINE=InnoDB;

-- RECIPES
CREATE TABLE recipes (
	id int(11) NOT NULL AUTO_INCREMENT,
	ctype int(11),
	cost decimal(5,2) NOT NULL,
	name varchar(255),
	FOREIGN KEY (ctype) REFERENCES cuisine_type (id),
	PRIMARY KEY (id)
)ENGINE=InnoDB;

-- CUSTOMERS
CREATE TABLE customers (
	id int(11) NOT NULL AUTO_INCREMENT,
	fname varchar(255) NOT NULL,
	lname varchar(255) NOT NULL,
	selections int(11),
	FOREIGN KEY (selections) REFERENCES recipes (id),
	PRIMARY KEY (id),
	UNIQUE KEY (fname, lname)
)ENGINE=InnoDB;

-- GEOGRAPHICAL LOCALE
CREATE TABLE geographical_locale (
	id int(11) NOT NULL AUTO_INCREMENT,
	name varchar(255),
	PRIMARY KEY (id)
)ENGINE=InnoDB;

-- DRIVERS
CREATE TABLE drivers (
	id int(11) NOT NULL AUTO_INCREMENT,
	fname varchar(255) NOT NULL,
	lname varchar(255) NOT NULL,
	works int(11) NOT NULL,
	FOREIGN KEY (works) REFERENCES geographical_locale (id),
	PRIMARY KEY (id),
	UNIQUE KEY (fname, lname)
)ENGINE=InnoDB;

-- ORDERS
CREATE TABLE orders (
	id int(11) NOT NULL AUTO_INCREMENT,
	ordered_by int(11),
	delivery_assign int(11) NOT NULL,
	FOREIGN KEY (ordered_by) REFERENCES customers (id),
	FOREIGN KEY (delivery_assign) REFERENCES drivers (id),
	PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE recipe_ingredients (
	itemID int(11) NOT NULL,
	recipeID int(11) NOT NULL,
	FOREIGN KEY (itemID) REFERENCES food_inventory (foodID),
	FOREIGN KEY (recipeID) REFERENCES recipes (id),
	PRIMARY KEY (itemID, recipeID)
)ENGINE=InnoDB;


-- ------------------------------------------------------------------------------
--                    INSERT TABLE DATA 
--    This portion populates the database with an inconsequential amount of data
--    to make testing easier.
-- ------------------------------------------------------------------------------

-- INSERT FOOD TYPE
INSERT into food_type values
	(NULL, 'vegtable'),
	(NULL, 'fruit'),
	(NULL, 'beef'),
	(NULL, 'poultry'),
	(NULL, 'fish'),
	(NULL, 'dairy'),
	(NULL, 'nuts'),
	(NULL, 'legumes'),
	(NULL, 'lab_created');
	
-- INSERT CUISINE TYPE
INSERT into cuisine_type values
	(NULL, 'traditional'),
	(NULL, 'vegetarian'),
	(NULL, 'paleo'),
	(NULL, 'gluten_free'),
	(NULL, 'dairy_free'),
	(NULL, 'heart_attack');
	
-- INSERT FOOD INVENTORY
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'carrot'); -- test worked
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'onion'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'cucumber'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'lettuce'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'spinach'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'tomato'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'potato'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'eggplant'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'celery'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'broccoli'),
	(NULL, (select id FROM food_type WHERE name = 'vegtable'), 'cauliflower');
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'apple'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'banana'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'orange'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'peach'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'strawberry'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'pear'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'watermelon'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'raspberry'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'pomegranate'),
	(NULL, (select id FROM food_type WHERE name = 'fruit'), 'coconut');	
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'beef'), 'filet'),
	(NULL, (select id FROM food_type WHERE name = 'beef'), 'sirloin'),
	(NULL, (select id FROM food_type WHERE name = 'beef'), 'prime_rib'),
	(NULL, (select id FROM food_type WHERE name = 'beef'), 'brisket'),
	(NULL, (select id FROM food_type WHERE name = 'beef'), 'ground');
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'poultry'), 'chicken'),
	(NULL, (select id FROM food_type WHERE name = 'poultry'), 'turkey');
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'fish'), 'salmon'),
	(NULL, (select id FROM food_type WHERE name = 'fish'), 'halibut'),
	(NULL, (select id FROM food_type WHERE name = 'fish'), 'trout'),
	(NULL, (select id FROM food_type WHERE name = 'fish'), 'bass'),
	(NULL, (select id FROM food_type WHERE name = 'fish'), 'tilapia');
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'dairy'), 'chedder'),
	(NULL, (select id FROM food_type WHERE name = 'dairy'), 'provolone'),
	(NULL, (select id FROM food_type WHERE name = 'dairy'), 'sour_cream');
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'nuts'), 'walnuts'),
	(NULL, (select id FROM food_type WHERE name = 'nuts'), 'almonds'),
	(NULL, (select id FROM food_type WHERE name = 'nuts'), 'pecans');
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'legumes'), 'pinto_bean'),
	(NULL, (select id FROM food_type WHERE name = 'legumes'), 'navy_bean'),
	(NULL, (select id FROM food_type WHERE name = 'legumes'), 'black_bean');
	
INSERT into food_inventory (foodID, ftype, name) values
	(NULL, (select id FROM food_type WHERE name = 'lab_created'), 'chemical_X'),
	(NULL, (select id FROM food_type WHERE name = 'lab_created'), 'twinkie_frog'),
	(NULL, (select id FROM food_type WHERE name = 'lab_created'), 'foodlike_syrup');
	
-- INSERT RECIPES	
INSERT into recipes (id, ctype, cost, name) values
	(NULL, (select id from cuisine_type WHERE name = 'vegetarian'), '5.50', 'chedder_broccoli_soup'),
	(NULL, (select id from cuisine_type WHERE name = 'traditional'), '9.50', 'turkey_casserole'),
	(NULL, (select id from cuisine_type WHERE name = 'paleo'), '12.00', 'spinach_wrapped_chicken'),
	(NULL, (select id from cuisine_type WHERE name = 'gluten_free'), '7.50', 'bean_almond_surprise'),
	(NULL, (select id from cuisine_type WHERE name = 'dairy_free'), '6.75', 'smoked_salmon'),
	(NULL, (select id from cuisine_type WHERE name = 'heart_attack'), '10.50', 'beef_platter');
	
-- INSERT RECIPE INGREDIENTS
INSERT into recipe_ingredients (itemID, recipeID) values
	((select foodID FROM food_inventory WHERE name = 'chedder'), (select id FROM recipes WHERE name = 'chedder_broccoli_soup')),
	((select foodID FROM food_inventory WHERE name = 'broccoli'), (select id FROM recipes WHERE name = 'chedder_broccoli_soup')),
	((select foodID FROM food_inventory WHERE name = 'sour_cream'), (select id FROM recipes WHERE name = 'chedder_broccoli_soup'));
	
INSERT into recipe_ingredients (itemID, recipeID) values
	((select foodID FROM food_inventory WHERE name = 'turkey'), (select id FROM recipes WHERE name = 'turkey_casserole')),
	((select foodID FROM food_inventory WHERE name = 'broccoli'), (select id FROM recipes WHERE name = 'turkey_casserole')),
	((select foodID FROM food_inventory WHERE name = 'provolone'), (select id FROM recipes WHERE name = 'turkey_casserole'));
	
INSERT into recipe_ingredients (itemID, recipeID) values
	((select foodID FROM food_inventory WHERE name = 'spinach'), (select id FROM recipes WHERE name = 'spinach_wrapped_chicken')),
	((select foodID FROM food_inventory WHERE name = 'chicken'), (select id FROM recipes WHERE name = 'spinach_wrapped_chicken')),
	((select foodID FROM food_inventory WHERE name = 'almonds'), (select id FROM recipes WHERE name = 'spinach_wrapped_chicken'));
	
INSERT into recipe_ingredients (itemID, recipeID) values
	((select foodID FROM food_inventory WHERE name = 'pinto_bean'), (select id FROM recipes WHERE name = 'bean_almond_surprise')),
	((select foodID FROM food_inventory WHERE name = 'almonds'), (select id FROM recipes WHERE name = 'bean_almond_surprise')),
	((select foodID FROM food_inventory WHERE name = 'chemical_X'), (select id FROM recipes WHERE name = 'bean_almond_surprise'));
	
INSERT into recipe_ingredients (itemID, recipeID) values
	((select foodID FROM food_inventory WHERE name = 'salmon'), (select id FROM recipes WHERE name = 'smoked_salmon')),
	((select foodID FROM food_inventory WHERE name = 'pecans'), (select id FROM recipes WHERE name = 'smoked_salmon')),
	((select foodID FROM food_inventory WHERE name = 'apple'), (select id FROM recipes WHERE name = 'smoked_salmon'));
	
INSERT into recipe_ingredients (itemID, recipeID) values
	((select foodID FROM food_inventory WHERE name = 'brisket'), (select id FROM recipes WHERE name = 'beef_platter')),
	((select foodID FROM food_inventory WHERE name = 'sirloin'), (select id FROM recipes WHERE name = 'beef_platter')),
	((select foodID FROM food_inventory WHERE name = 'sour_cream'), (select id FROM recipes WHERE name = 'beef_platter'));
	
-- INSERT CUSTOMERS
INSERT into customers (id, fname, lname, selections) values
	(NULL, 'Jack', 'Palance', (select id FROM recipes WHERE name = 'smoked_salmon'));
	
INSERT into customers (id, fname, lname, selections) values
	(NULL, 'Jane', 'Fonda', (select id FROM recipes WHERE name = 'smoked_salmon')),
	(NULL, 'Eric', 'Bogosian', (select id FROM recipes WHERE name = 'chedder_broccoli_soup')),
	(NULL, 'Sally', 'Ride', (select id FROM recipes WHERE name = 'bean_almond_surprise')),
	(NULL, 'Gordon', 'Gekko', (select id FROM recipes WHERE name = 'beef_platter')),
	(NULL, 'Oprah', 'Winfrey', (select id FROM recipes WHERE name = 'spinach_wrapped_chicken'));
	
-- INSERT GEOGRAPHICAL LOCALES
INSERT into geographical_locale (id, name) values
	(NULL, 'north'),
	(NULL, 'south'),
	(NULL, 'east'),
	(NULL, 'west');
	
-- INSERT DRIVERS
INSERT into drivers (id, fname, lname, works) values
	(NULL, 'Frank', 'Zappa', (select id FROM geographical_locale WHERE name = 'north')),
	(NULL, 'Bob', 'Saget', (select id FROM geographical_locale WHERE name = 'south')),
	(NULL, 'Lizzie', 'Borden', (select id FROM geographical_locale WHERE name = 'east')),
	(NULL, 'Marsha', 'Brady', (select id FROM geographical_locale WHERE name = 'west'));
	
-- INSERT ORDERS
INSERT into orders (id, ordered_by, )

	
	
	
	
	
	
