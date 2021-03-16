
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `template` varchar(150) DEFAULT NULL,
  `vars` text DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `state` int(11) DEFAULT 1,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `tracking_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

-
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

