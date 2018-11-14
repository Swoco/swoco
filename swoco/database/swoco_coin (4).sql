-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2018 at 09:03 AM
-- Server version: 5.6.41-84.1-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swoco_coin`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy_token`
--

CREATE TABLE `buy_token` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `user_ref_id` varchar(100) NOT NULL,
  `sell_user_id` varchar(200) NOT NULL,
  `token_quantity` varchar(200) NOT NULL,
  `income` varchar(100) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `phase` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `buy_date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `create_ticket`
--

CREATE TABLE `create_ticket` (
  `ticket_id` int(11) NOT NULL,
  `agent_id` text NOT NULL,
  `user_id` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `attachments` text NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `generate_date` datetime NOT NULL,
  `reply_status` int(11) NOT NULL,
  `last_update_date` datetime NOT NULL,
  `close_ticket` int(11) NOT NULL,
  `close_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locked_amount`
--

CREATE TABLE `locked_amount` (
  `id` int(11) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `token` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkway_userpay_list`
--

CREATE TABLE `milkway_userpay_list` (
  `id` int(11) NOT NULL,
  `se_id` varchar(255) NOT NULL,
  `rd_id` varchar(255) NOT NULL,
  `mode` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_rf_id` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `verify_number` varchar(255) NOT NULL,
  `ord_id` varchar(255) NOT NULL,
  `qnty` varchar(50) NOT NULL,
  `unit_price` varchar(50) NOT NULL,
  `total_price` varchar(50) NOT NULL,
  `commission_percent` varchar(50) NOT NULL,
  `grand_total_amt` varchar(255) NOT NULL,
  `phase_mode` varchar(50) NOT NULL,
  `inv_type` varchar(50) NOT NULL,
  `inv_type_amt` varchar(50) NOT NULL,
  `user_percent_status` varchar(20) NOT NULL,
  `userpercent_done_dtime` varchar(50) NOT NULL,
  `temp_add` varchar(50) NOT NULL,
  `added_date` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `pay_via_panel` varchar(20) NOT NULL,
  `eth_status` varchar(50) NOT NULL,
  `remarks` varchar(100) NOT NULL,
  `pay_datetime` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_adminassigncoin`
--

CREATE TABLE `milkyway_adminassigncoin` (
  `id` int(11) NOT NULL,
  `total_coin_qty` varchar(255) NOT NULL,
  `ico_percentage` varchar(20) NOT NULL,
  `grand_totalcoin` varchar(50) NOT NULL,
  `totalcoin` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `rem_perc_coin` varchar(50) NOT NULL,
  `rem_total_coin_qty` varchar(20) NOT NULL,
  `admin_fee` varchar(20) NOT NULL,
  `mod_date` varchar(50) NOT NULL,
  `add_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_adminassigncoin_logfile`
--

CREATE TABLE `milkyway_adminassigncoin_logfile` (
  `id` int(11) NOT NULL,
  `mode` varchar(20) NOT NULL,
  `order_no` varchar(50) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `totalcoin` varchar(50) NOT NULL,
  `amt` varchar(255) NOT NULL,
  `add_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_adminlogin`
--

CREATE TABLE `milkyway_adminlogin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `add_date` varchar(255) NOT NULL,
  `last_login_dtime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milkyway_adminlogin`
--

INSERT INTO `milkyway_adminlogin` (`id`, `name`, `type`, `email`, `contact`, `pswd`, `status`, `add_date`, `last_login_dtime`) VALUES
(1, 'Admin', 'admin', 'info@swoco.io', '1111111111', '21232f297a57a5a743894a0e4a801fc3', '1', '2018-06-19', '14-11-2018 02:22:58'),
(2, 'Sub Admin', 'subadmin', 'subadmin@gmail.com', '1111111111', 'e10adc3949ba59abbe56e057f20f883e', '1', '', '06-08-2018 03:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_buysendotp`
--

CREATE TABLE `milkyway_buysendotp` (
  `id` int(11) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `add_date` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_contact`
--

CREATE TABLE `milkyway_contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `add_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_icocoin`
--

CREATE TABLE `milkyway_icocoin` (
  `id` int(11) NOT NULL,
  `grand_tot_coin` varchar(50) NOT NULL,
  `total_coin` int(11) NOT NULL,
  `unit_coin_prc` varchar(255) NOT NULL,
  `curr_symbol` varchar(20) NOT NULL,
  `phase` varchar(50) NOT NULL,
  `phase_duration` varchar(20) NOT NULL,
  `date_duration` varchar(255) NOT NULL,
  `phase_percent` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `start` varchar(20) NOT NULL,
  `end` varchar(20) NOT NULL,
  `complete` enum('0','1') NOT NULL,
  `add_date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_level_percentage`
--

CREATE TABLE `milkyway_level_percentage` (
  `id` int(11) NOT NULL,
  `level` varchar(100) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_level__income`
--

CREATE TABLE `milkyway_level__income` (
  `id` int(11) NOT NULL,
  `rd_id` varchar(200) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `ref_amt` varchar(50) NOT NULL,
  `percent_amt` varchar(50) NOT NULL,
  `income_level` varchar(10) NOT NULL,
  `ref_status` varchar(20) NOT NULL,
  `pay_status` varchar(10) NOT NULL,
  `add_date` varchar(50) NOT NULL,
  `up_date` varchar(20) NOT NULL,
  `percent_amt_qty` varchar(50) NOT NULL,
  `inc_transfer_status` varchar(20) NOT NULL,
  `inc_transfer_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_level__income1`
--

CREATE TABLE `milkyway_level__income1` (
  `id` int(11) NOT NULL,
  `rd_id` varchar(200) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `ref_id` varchar(50) NOT NULL,
  `ref_amt` varchar(50) NOT NULL,
  `percent_amt` varchar(50) NOT NULL,
  `income_level` varchar(10) NOT NULL,
  `ref_status` varchar(20) NOT NULL,
  `pay_status` varchar(10) NOT NULL,
  `add_date` varchar(50) NOT NULL,
  `up_date` varchar(20) NOT NULL,
  `percent_amt_qty` varchar(50) NOT NULL,
  `inc_transfer_status` varchar(20) NOT NULL,
  `inc_transfer_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_request_chk`
--

CREATE TABLE `milkyway_request_chk` (
  `id` int(11) NOT NULL,
  `pageurl` varchar(255) NOT NULL,
  `requestfile` text NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_sendotp`
--

CREATE TABLE `milkyway_sendotp` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `add_date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_swoco_list`
--

CREATE TABLE `milkyway_swoco_list` (
  `id` int(11) NOT NULL,
  `token_price` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `add_date` varchar(255) NOT NULL,
  `add_datetime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_userlogin_log`
--

CREATE TABLE `milkyway_userlogin_log` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `server_add` varchar(255) NOT NULL,
  `remote_add` varchar(255) NOT NULL,
  `add_date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_usernotification`
--

CREATE TABLE `milkyway_usernotification` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `add_date` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_usersignup`
--

CREATE TABLE `milkyway_usersignup` (
  `id` int(11) NOT NULL,
  `reference_id` varchar(50) NOT NULL,
  `link_reference_id` varchar(50) NOT NULL,
  `bitcoin_wallet_address` varchar(255) NOT NULL,
  `swoco_wallet_address` varchar(255) NOT NULL,
  `swoco_mobile_wallet_address` varchar(255) NOT NULL,
  `litecoin_wallet_address` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `address` text NOT NULL,
  `country` varchar(20) NOT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pin` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rnd_pass` varchar(50) NOT NULL,
  `signup_via` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `reference_status` varchar(10) NOT NULL,
  `reference_url` varchar(255) NOT NULL,
  `mob_verification` enum('0','1') NOT NULL,
  `verification` varchar(255) NOT NULL,
  `uni_session_id` varchar(255) NOT NULL,
  `uni_time` varchar(255) NOT NULL,
  `login_status` enum('0','1') NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `milkyway_usersupport`
--

CREATE TABLE `milkyway_usersupport` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `ticket_no` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `msg` text NOT NULL,
  `response_msg` text NOT NULL,
  `support_status` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `user_add_date` varchar(20) NOT NULL,
  `response_adddate` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_token`
--

CREATE TABLE `payment_token` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reinvestment_token`
--

CREATE TABLE `reinvestment_token` (
  `id` int(11) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `user_ref_id` varchar(100) NOT NULL,
  `token` varchar(200) NOT NULL,
  `total_token` varchar(200) NOT NULL,
  `coin_price` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `reward_id` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `quntity` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sell_percent`
--

CREATE TABLE `sell_percent` (
  `id` int(11) NOT NULL,
  `percent` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sell_token`
--

CREATE TABLE `sell_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_ref_id` varchar(100) NOT NULL,
  `token_percent` varchar(100) NOT NULL,
  `sell_phase` varchar(200) NOT NULL,
  `buy_phase` varchar(200) NOT NULL,
  `total_token` varchar(200) NOT NULL,
  `token_per_amount` varchar(200) NOT NULL,
  `sell_token` varchar(200) NOT NULL,
  `update_sell_token` varchar(100) NOT NULL,
  `order_id` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `sell_date` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `sell_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_reply`
--

CREATE TABLE `ticket_reply` (
  `reply_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `agent_id` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `attachments` text NOT NULL,
  `status` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `reply_name` text NOT NULL,
  `notification_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload_purchase_swoco`
--

CREATE TABLE `upload_purchase_swoco` (
  `id` int(11) NOT NULL,
  `sell_user_id` varchar(100) NOT NULL,
  `buy_user_id` varchar(100) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `income` varchar(100) NOT NULL,
  `btc_amount` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int(11) NOT NULL,
  `trns_id` varchar(200) NOT NULL,
  `user_id` varchar(200) NOT NULL,
  `user_ref_id` varchar(100) NOT NULL,
  `amount` varchar(200) NOT NULL,
  `btc_amount` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy_token`
--
ALTER TABLE `buy_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `create_ticket`
--
ALTER TABLE `create_ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `locked_amount`
--
ALTER TABLE `locked_amount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkway_userpay_list`
--
ALTER TABLE `milkway_userpay_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_adminassigncoin`
--
ALTER TABLE `milkyway_adminassigncoin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_adminassigncoin_logfile`
--
ALTER TABLE `milkyway_adminassigncoin_logfile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_adminlogin`
--
ALTER TABLE `milkyway_adminlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_buysendotp`
--
ALTER TABLE `milkyway_buysendotp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_contact`
--
ALTER TABLE `milkyway_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_icocoin`
--
ALTER TABLE `milkyway_icocoin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_level_percentage`
--
ALTER TABLE `milkyway_level_percentage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_level__income`
--
ALTER TABLE `milkyway_level__income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_level__income1`
--
ALTER TABLE `milkyway_level__income1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_request_chk`
--
ALTER TABLE `milkyway_request_chk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_sendotp`
--
ALTER TABLE `milkyway_sendotp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_swoco_list`
--
ALTER TABLE `milkyway_swoco_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_userlogin_log`
--
ALTER TABLE `milkyway_userlogin_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_usernotification`
--
ALTER TABLE `milkyway_usernotification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_usersignup`
--
ALTER TABLE `milkyway_usersignup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milkyway_usersupport`
--
ALTER TABLE `milkyway_usersupport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_token`
--
ALTER TABLE `payment_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reinvestment_token`
--
ALTER TABLE `reinvestment_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_percent`
--
ALTER TABLE `sell_percent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_token`
--
ALTER TABLE `sell_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `upload_purchase_swoco`
--
ALTER TABLE `upload_purchase_swoco`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buy_token`
--
ALTER TABLE `buy_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `create_ticket`
--
ALTER TABLE `create_ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `locked_amount`
--
ALTER TABLE `locked_amount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `milkway_userpay_list`
--
ALTER TABLE `milkway_userpay_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `milkyway_adminassigncoin`
--
ALTER TABLE `milkyway_adminassigncoin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `milkyway_adminassigncoin_logfile`
--
ALTER TABLE `milkyway_adminassigncoin_logfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `milkyway_adminlogin`
--
ALTER TABLE `milkyway_adminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `milkyway_buysendotp`
--
ALTER TABLE `milkyway_buysendotp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `milkyway_contact`
--
ALTER TABLE `milkyway_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `milkyway_icocoin`
--
ALTER TABLE `milkyway_icocoin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `milkyway_level_percentage`
--
ALTER TABLE `milkyway_level_percentage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `milkyway_level__income`
--
ALTER TABLE `milkyway_level__income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=644;

--
-- AUTO_INCREMENT for table `milkyway_level__income1`
--
ALTER TABLE `milkyway_level__income1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=579;

--
-- AUTO_INCREMENT for table `milkyway_request_chk`
--
ALTER TABLE `milkyway_request_chk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `milkyway_sendotp`
--
ALTER TABLE `milkyway_sendotp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `milkyway_swoco_list`
--
ALTER TABLE `milkyway_swoco_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `milkyway_userlogin_log`
--
ALTER TABLE `milkyway_userlogin_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1660;

--
-- AUTO_INCREMENT for table `milkyway_usernotification`
--
ALTER TABLE `milkyway_usernotification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `milkyway_usersignup`
--
ALTER TABLE `milkyway_usersignup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `milkyway_usersupport`
--
ALTER TABLE `milkyway_usersupport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payment_token`
--
ALTER TABLE `payment_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `reinvestment_token`
--
ALTER TABLE `reinvestment_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sell_percent`
--
ALTER TABLE `sell_percent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sell_token`
--
ALTER TABLE `sell_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ticket_reply`
--
ALTER TABLE `ticket_reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `upload_purchase_swoco`
--
ALTER TABLE `upload_purchase_swoco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
