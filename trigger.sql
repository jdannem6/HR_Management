
 Triggers `employee`

DROP TRIGGER IF EXISTS `team_mem_de`;
DELIMITER $$
CREATE TRIGGER `team_mem_de` BEFORE DELETE ON `employee` FOR EACH ROW update team set team.total_members = team.total_members - 1 where team.team_name = old.team_name
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `team_mem_ins`;
DELIMITER $$
CREATE TRIGGER `team_mem_ins` BEFORE INSERT ON `employee` FOR EACH ROW update team set team.total_members = team.total_members + 1 where team.team_name = new.team_name
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `team_mem_up`;
DELIMITER $$
CREATE TRIGGER `team_mem_up` BEFORE UPDATE ON `employee` FOR EACH ROW BEGIN 
IF new.team_name <> old.team_name THEN
	update team set team.total_members = team.total_members + 1 where team.team_name 	= new.team_name;
	update team set team.total_members = team.total_members - 1 where team.team_name 	= old.team_name;
END if;
end
$$
DELIMITER ;

--
-- Constraints for table `employee`
--
--ALTER TABLE `employee`
 -- ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`dept_name`) REFERENCES `department` (`dept_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  --ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`team_name`) REFERENCES `team` (`team_name`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `team`
--
--ALTER TABLE `team`
  --ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

 