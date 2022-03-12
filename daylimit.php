<?php
    $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816", "junseok816", "tlsrn815");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $q1= $db->exec(
                        "UPDATE tbl_project SET f_div = 'N' WHERE DATEDIFF(tbl_project.f_date_limit , CURDATE()) < -1;"
                    );
                    
                            
?>
