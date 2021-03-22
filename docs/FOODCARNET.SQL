DROP DATABASE IF EXISTS foodcarnet;

CREATE DATABASE IF NOT EXISTS foodcarnet;

USE foodcarnet;

# -----------------------------------------------------------------------------
#       TABLE : IMAGE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS IMAGE
 (
   IDIMAGE INTEGER NOT NULL AUTO_INCREMENT ,
   IDRECIPE INTEGER NOT NULL  ,
   NAME CHAR(255) NULL  ,
   PATH TEXT NULL  ,
   ALT TEXT NULL  
   , PRIMARY KEY (IDIMAGE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE IMAGE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_IMAGE_RECIPE
     ON IMAGE (IDRECIPE ASC);

# -----------------------------------------------------------------------------
#       TABLE : FIX
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS FIX
 (
   IDFIX INTEGER NOT NULL AUTO_INCREMENT ,
   NAME CHAR(255) NULL  
   , PRIMARY KEY (IDFIX) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CATEGORY
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CATEGORY
 (
   IDCATEGORY INTEGER NOT NULL AUTO_INCREMENT ,
   NAME CHAR(255) NULL  
   , PRIMARY KEY (IDCATEGORY) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : RECIPE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS RECIPE
 (
   IDRECIPE INTEGER NOT NULL AUTO_INCREMENT ,
   IDFIX INTEGER NOT NULL  ,
   IDCATEGORY INTEGER NOT NULL  ,
   NAME CHAR(255) NULL  ,
   DESCRIPTION TEXT NULL  ,
   TIMETOCOMPLETE TIME NULL  ,
   VIEWNUMBER BIGINT(4) NULL  ,
   PRICE DECIMAL(10,2) NULL  
   , PRIMARY KEY (IDRECIPE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE RECIPE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_RECIPE_FIX
     ON RECIPE (IDFIX ASC);

CREATE  INDEX I_FK_RECIPE_CATEGORY
     ON RECIPE (IDCATEGORY ASC);

# -----------------------------------------------------------------------------
#       TABLE : INGREDIENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INGREDIENT
 (
   IDINGREDIENT INTEGER NOT NULL AUTO_INCREMENT ,
   NAME CHAR(32) NULL  
   , PRIMARY KEY (IDINGREDIENT) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CONTAINS
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONTAINS
 (
   IDINGREDIENT INTEGER NOT NULL  ,
   IDRECIPE INTEGER NOT NULL  
   , PRIMARY KEY (IDINGREDIENT,IDRECIPE) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE CONTAINS
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_CONTAINS_INGREDIENT
     ON CONTAINS (IDINGREDIENT ASC);

CREATE  INDEX I_FK_CONTAINS_RECIPE
     ON CONTAINS (IDRECIPE ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE IMAGE 
  ADD FOREIGN KEY FK_IMAGE_RECIPE (IDRECIPE)
      REFERENCES RECIPE (IDRECIPE) ;


ALTER TABLE RECIPE 
  ADD FOREIGN KEY FK_RECIPE_FIX (IDFIX)
      REFERENCES FIX (IDFIX) ;


ALTER TABLE RECIPE 
  ADD FOREIGN KEY FK_RECIPE_CATEGORY (IDCATEGORY)
      REFERENCES CATEGORY (IDCATEGORY) ;


ALTER TABLE CONTAINS 
  ADD FOREIGN KEY FK_CONTAINS_INGREDIENT (IDINGREDIENT)
      REFERENCES INGREDIENT (IDINGREDIENT) ;


ALTER TABLE CONTAINS 
  ADD FOREIGN KEY FK_CONTAINS_RECIPE (IDRECIPE)
      REFERENCES RECIPE (IDRECIPE) ;

