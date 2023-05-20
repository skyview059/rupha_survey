/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  LENOVO
 * Created: Dec 8, 2022
 */

ALTER TABLE `member_relatives` ADD FOREIGN KEY (`member_id`) REFERENCES `members`(`id`) ON DELETE CASCADE ON UPDATE NO ACTION;


--- আর্নিকা কত মিনিট পর পর ব্যথা জায়গায় দেখা যায়?


/* Date: 20th May 2023 */
ALTER TABLE `members` ADD `profession` VARCHAR(120) NULL AFTER `nid`;
