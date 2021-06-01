/* alter the tables */
ALTER TABLE jokes 
    CHANGE create_date created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP; 

/* jokes */
ALTER TABLE jokes
    ADD updated_by VARCHAR(50) NULL AFTER created_at, 
    ADD updated_at TIMESTAMP NULL AFTER updated_by; 

/* update the fields */
/* jokes */
UPDATE jokes SET updated_by = "ADMIN";