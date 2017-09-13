ALTER TABLE `config_admin` ADD `recaptcha_secret_key` VARCHAR(60) NOT NULL , ADD `recaptcha_site_key` VARCHAR(60) NOT NULL ;

UPDATE `config_admin` SET `recaptcha_secret_key` = '6LczwC4UAAAAAFIpgTKF9vSuCJ5GlX-AtUCsEr6n' WHERE `config_admin`.`id` = 1;
UPDATE `config_admin` SET `recaptcha_site_key` = '6LczwC4UAAAAAA2EBXrcrZYujyvgMthPMv-icNeA' WHERE `config_admin`.`id` = 1;


ALTER TABLE `comentarios_blog` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;


