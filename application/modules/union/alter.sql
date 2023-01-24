/**
 * Author:  LENOVO
 * Created: Jan 11, 2023
 */

ALTER TABLE `bd_unions` DROP `url`;
ALTER TABLE `bd_districts` DROP `url`;
ALTER TABLE `bd_districts` DROP `lat`, DROP `lon`;
ALTER TABLE `bd_divisions` DROP `url`;
ALTER TABLE `bd_upazilas` DROP `url`;


ALTER TABLE `member_annual_tax` 
    ADD FOREIGN KEY (`member_id`) REFERENCES `members`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/* --- 
SELECT * FROM `members` WHERE id NOT in( SELECT member_id FROM `member_annual_tax`  );
SELECT * FROM `member_annual_tax` where member_id NOT IN ( SELECT id FROM members );
--- */