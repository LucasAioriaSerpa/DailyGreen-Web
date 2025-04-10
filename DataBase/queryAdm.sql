-- CADASTRO ADM

USE db_dailygreen;

INSERT INTO administrador (email,password) VALUES (
    /* 
    '{$email}',
    '{$password}'
    */
)

-- LOGIN ADM

SELECT email, senha FROM db_dailygreen.administrador WHERE email = -- {$email};