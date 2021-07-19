-- The following changes were made to the database:

-- 1. `customers_deliveryman` table deleted.
    -- READ THIS
    -- This table was deleted from the ERD after the presentation but Visual Paradigm still added these for some reason.

DROP TABLE customers_deliveryman;

-- 2. `customers_recipes_foods` table deleted.
    -- READ THIS
    -- This table was deleted from the ERD after the presentation but Visual Paradigm still added these for some reason.

DROP TABLE 	customers_recipes_foods;

-- 3. Added email column in employees table.

ALTER TABLE employees
ADD email varchar(320) NOT NULL UNIQUE;

-- 4. Added password column in employees table.

ALTER TABLE employees
ADD password varchar(100) NOT NULL;


-- 5. Added data record to employees table.

-- INSERT INTO employees (email, password, first_name, last_name, start_date, salary, job_title, department_id)
-- VALUES ('shabab@gmail.com', '12345', 'Shabab', 'Noor', '2021-05-01', '10000', 'admin', '10');

-- 6. Added data record to ingredients table.
 
-- INSERT INTO ingredients (name, calories, carbs, fat, protein, measurement_unit, measurement_amount, current_amount, current_amount_unit) 
-- VALUES ('White Rice', 130, 29, 0, 2, 'gram', 100, 100, 'kilo-gram');

-- INSERT INTO ingredients (name, calories, carbs, fat, protein, measurement_unit, measurement_amount, current_amount, current_amount_unit) 
-- VALUES ('Onion - Desi', 40, 9, 0, 1, 'gram', 100, 70, 'kilo-gram');

-- INSERT INTO ingredients (name, calories, carbs, fat, protein, measurement_unit, measurement_amount, current_amount, current_amount_unit) 
-- VALUES ('Salt', 0, 0, 0, 0, 'gram', 1, 50, 'kilo-gram');

-- INSERT INTO ingredients (name, calories, carbs, fat, protein, measurement_unit, measurement_amount, current_amount, current_amount_unit) 
-- VALUES ('Sugar', 387, 100, 0, 0, 'gram', 100, 60, 'kilo-gram');


-- 7. Modified name column in recipes table: it was accidentally set to int before

ALTER TABLE `recipes`
MODIFY COLUMN name varchar(100);

-- 8. Added price column in ingredients table for modular calculation

ALTER TABLE ingredients
ADD price double;

-- 9. Added yt_link (Youtube Link) column on recipes table as suggested by Imam sir on Update-01

ALTER TABLE recipes
ADD yt_link varchar(100);

-- 10. Altered password column in customers and employees table to allow 100chars for encrypted password

ALTER TABLE customers
MODIFY password varchar(100);

ALTER TABLE employees
MODIFY password varchar(100);

-- 11. Inserted data record to customers table

-- INSERT INTO customers(first_name, last_name, dob, email, password, phone, join_date, gender, height, weight)
-- VALUES('Shabab', 'Noor', '1990-01-01', 'shabab@gmail.com', '12345', '01xxxxxxxxx', '2021-05-01', 'male', 165, 80);

-- 12. Added total_price column in recipes table

ALTER TABLE recipes
ADD total_price double;

-- 13. Added total_fat, total_carb and total_protein in recipes table

ALTER TABLE recipes
ADD total_fat double;

ALTER TABLE recipes
ADD total_carb double;

ALTER TABLE recipes
ADD total_protein double;

-- 14. Deleted percentage column and added unit column instead to `ingredient_attributes_info` table

ALTER TABLE ingredient_attributes_info
DROP COLUMN percentage;

ALTER TABLE ingredient_attributes_info
ADD unit varchar(20);