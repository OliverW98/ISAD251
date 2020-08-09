CREATE DEFINER=`ISAD251_OWilkes`@`%` PROCEDURE `recordDeadline`(in `inUserID` int , in `inDeadlineDate` datetime, in `inDeadlineDetails` varchar(200), in `inDeadlineMet` varchar(5))
BEGIN
insert into deadlines (deadlineUserID , deadlineDate , deadlineDetails , deadlineMet)
values (inUserID , inDeadlineDate , inDeadlineDetails , inDeadlineMet);
END