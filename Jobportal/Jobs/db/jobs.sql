# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Aug 27, 2004 at 05:53 PM
# Server version: 4.00.04
# PHP Version: 4.2.3
# Database : `sbjobseekers`
# --------------------------------------------------------

#
# Table structure for table `sbjbs_admin`
#

DROP TABLE IF EXISTS `sbjbs_admin`;
CREATE TABLE `sbjbs_admin` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_admin_name` varchar(255) default NULL,
  `sb_pwd` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_admin`
#

INSERT INTO `sbjbs_admin` (`sb_id`, `sb_admin_name`, `sb_pwd`) VALUES (1, 'admin', 'admin');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_ads`
#

DROP TABLE IF EXISTS `sbjbs_ads`;
CREATE TABLE `sbjbs_ads` (
  `sbtitle` varchar(255) default NULL,
  `id` bigint(20) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL default '',
  `bannerurl` varchar(255) NOT NULL default '',
  `credits` bigint(20) NOT NULL default '0',
  `displays` bigint(20) NOT NULL default '0',
  `approved` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_ads`
#

INSERT INTO `sbjbs_ads` (`sbtitle`, `id`, `url`, `bannerurl`, `credits`, `displays`, `approved`) VALUES ('vin.com', 21, 'http://vin.com', 'http://localhost/sbclassified_harvey/changes/Sulekha_com_files/600_60_a1wireless.jpg', 1000, 225, 'no'),
('micx', 22, 'http://micx.com', 'http://localhost/sbclassified_harvey/changes/Sulekha_com_files/120_120_invis_4.gif', 1000, 300, 'no');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_affiliate_banner`
#

DROP TABLE IF EXISTS `sbjbs_affiliate_banner`;
CREATE TABLE `sbjbs_affiliate_banner` (
  `sbaff_id` bigint(20) NOT NULL auto_increment,
  `sbaff_title` varchar(255) default NULL,
  `sbaff_text` longtext,
  `sbaff_active` varchar(255) NOT NULL default 'no',
  PRIMARY KEY  (`sbaff_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_affiliate_banner`
#

INSERT INTO `sbjbs_affiliate_banner` (`sbaff_id`, `sbaff_title`, `sbaff_text`, `sbaff_active`) VALUES (6, 'Default', '<a href="linktous.php"><img src=http://localhost/sbtradeleads/images/default_banner.gif border=0 alt="Advertise Here"></a>', 'no');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_affiliations`
#

DROP TABLE IF EXISTS `sbjbs_affiliations`;
CREATE TABLE `sbjbs_affiliations` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_resume_id` bigint(20) default NULL,
  `sb_affiliation` varchar(255) default NULL,
  `sb_start_month` int(11) default NULL,
  `sb_start_year` int(11) default NULL,
  `sb_end_month` int(11) default NULL,
  `sb_end_year` int(11) default NULL,
  `sb_company` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_affiliations`
#

INSERT INTO `sbjbs_affiliations` (`sb_id`, `sb_resume_id`, `sb_affiliation`, `sb_start_month`, `sb_start_year`, `sb_end_month`, `sb_end_year`, `sb_company`) VALUES (34, 49, 'Consultant', 1, 2003, 1, 2004, 'ABC corp pvt. ltd.'),
(30, 45, 'Consultant', 1, 2004, 13, 2004, 'XYZ incorporations'),
(28, 39, '\'', 1, 2004, 13, 2004, '\''),
(33, 49, 'Consultant', 1, 2004, 13, 2004, 'XYZ incorporations'),
(31, 45, 'Consultant', 1, 2003, 1, 2004, 'ABC corp pvt. ltd.'),
(35, 50, 'Consultant', 1, 2003, 1, 2004, 'ABC corp pvt. ltd.'),
(36, 50, 'Consultant', 1, 2004, 13, 2004, 'XYZ incorporations');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_applications`
#

DROP TABLE IF EXISTS `sbjbs_applications`;
CREATE TABLE `sbjbs_applications` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_job_id` bigint(20) NOT NULL default '0',
  `sb_resume_id` bigint(20) NOT NULL default '0',
  `sb_cover_id` bigint(20) NOT NULL default '0',
  `sb_seeker_id` bigint(20) NOT NULL default '0',
  `sbtemp` timestamp(14) NOT NULL,
  `sb_applied_on` timestamp(14) NOT NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_applications`
#

INSERT INTO `sbjbs_applications` (`sb_id`, `sb_job_id`, `sb_resume_id`, `sb_cover_id`, `sb_seeker_id`, `sbtemp`, `sb_applied_on`) VALUES (1, 1, 15, 0, 3, 20040625125435, 20040616162256),
(3, 23, 15, 0, 3, 20040621160435, 20040621160435),
(12, 1, 39, 40, 12, 20040626104646, 20040626104646),
(13, 42, 39, 40, 12, 20040626122603, 20040626122603),
(15, 28, 25, 15, 3, 20040706121523, 20040706121523),
(16, 42, 50, 0, 10, 20040708122344, 20040708122344),
(17, 49, 49, 0, 10, 20040826155218, 20040826155218);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_businesstypes`
#

DROP TABLE IF EXISTS `sbjbs_businesstypes`;
CREATE TABLE `sbjbs_businesstypes` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_businesstype` varchar(255) default '',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_businesstypes`
#

INSERT INTO `sbjbs_businesstypes` (`sb_id`, `sb_businesstype`) VALUES (1, 'Corporate (Based in India)'),
(2, 'Placement Agency'),
(5, 'Company (Based Outside India)');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_categories`
#

DROP TABLE IF EXISTS `sbjbs_categories`;
CREATE TABLE `sbjbs_categories` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_cat_name` varchar(255) default NULL,
  `sb_pid` bigint(20) default NULL,
  `sb_order_index` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_categories`
#

INSERT INTO `sbjbs_categories` (`sb_id`, `sb_cat_name`, `sb_pid`, `sb_order_index`) VALUES (1, 'Administrative Services', 0, 1),
(2, 'Engineering Services', 0, 2),
(3, 'Marketing/Public Relations', 0, 3),
(4, 'Aerospace/Aviation/Defense', 0, 4),
(5, 'Computer Science', 2, 5),
(6, 'Mechanical', 2, 6),
(7, 'Agriculture Services', 0, 7),
(8, 'Architectural Services', 0, 8),
(14, 'Mass Communications', 0, 14),
(15, 'Pharmaceuticals', 0, 15),
(16, 'Construction & Mining', 0, 16),
(17, 'Consulting Services', 0, 17),
(18, 'Consumer Products', 0, 18),
(24, 'Customer Care Services', 0, 24),
(25, 'Educational Services', 0, 25),
(26, 'Placement Agencies', 0, 26),
(27, 'Financial Services', 0, 27),
(28, 'Accounting/Auditing', 27, 28),
(29, 'Banking', 27, 29),
(30, 'Finance/Economics', 27, 30),
(31, 'Insurance', 27, 31),
(32, 'Government and Policy', 0, 32),
(33, 'Healthcare Services', 0, 33),
(34, 'Nursing', 33, 34),
(38, 'Administration', 33, 38),
(39, 'Allied Health', 33, 39),
(40, 'LaboratoryServices', 33, 40),
(41, 'Medical Practitioners', 33, 41),
(42, 'Senior Management', 0, 42);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_companies`
#

DROP TABLE IF EXISTS `sbjbs_companies`;
CREATE TABLE `sbjbs_companies` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_uid` bigint(20) NOT NULL default '0',
  `sb_name` varchar(255) default NULL,
  `sb_type` bigint(20) default NULL,
  `sb_location` varchar(255) default NULL,
  `sb_country` bigint(20) NOT NULL default '1',
  `sb_industry` bigint(20) default '0',
  `sb_sales` varchar(255) default NULL,
  `sb_currency` bigint(20) NOT NULL default '0',
  `sb_multiplier` varchar(255) default NULL,
  `sb_no_of_emps` varchar(255) default NULL,
  `sb_no_of_officies` varchar(255) default NULL,
  `sb_profile` longtext,
  `sb_logo` varchar(255) default NULL,
  `sb_website` varchar(255) default NULL,
  `sb_viewed` bigint(20) NOT NULL default '0',
  `sb_approved` varchar(255) default 'no',
  `tempdate` timestamp(14) NOT NULL,
  `sb_posted_on` timestamp(14) NOT NULL,
  `sb_show_profile` varchar(255) NOT NULL default 'no',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_companies`
#

INSERT INTO `sbjbs_companies` (`sb_id`, `sb_uid`, `sb_name`, `sb_type`, `sb_location`, `sb_country`, `sb_industry`, `sb_sales`, `sb_currency`, `sb_multiplier`, `sb_no_of_emps`, `sb_no_of_officies`, `sb_profile`, `sb_logo`, `sb_website`, `sb_viewed`, `sb_approved`, `tempdate`, `sb_posted_on`, `sb_show_profile`) VALUES (1, 4, 'Placement Consultants', 2, 'New Hampshire', 210, 6, '10-100', 2, 'million', '25-100 People', '10+', '<P><FONT face=Arial color=#993399 size=2><STRONG><FONT color=#990000>Company History</FONT></STRONG><BR><FONT color=#333333>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></FONT></P><FONT face=Arial color=#333333 size=2>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG></STRONG></FONT>&nbsp;</P>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG>Current Status</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#003300 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL>\r\n<P><FONT face=Arial color=#660000 size=2><STRONG>Future Plans</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#333333 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL></FONT>', '26273507.gif', 'www.domain.com', 0, 'yes', 20040706181213, 20040706180956, 'yes'),
(2, 4, 'Consultancy Services', 5, 'New Jersey', 210, 8, '10-100', 3, 'million', '100-500 People', '10+', '<P><FONT face=Arial color=#993399 size=2><STRONG><FONT color=#990000>Company History</FONT></STRONG><BR><FONT color=#333333>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></FONT></P><FONT face=Arial color=#333333 size=2>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG></STRONG></FONT>&nbsp;</P>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG>Current Status</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#003300 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL>\r\n<P><FONT face=Arial color=#660000 size=2><STRONG>Future Plans</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#333333 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL></FONT>', '34198693.gif', 'www.domain.com', 0, 'yes', 20040706181946, 20040706180956, 'yes'),
(3, 5, 'e Placement Cell', 2, 'New Jersey', 210, 5, '10-100', 3, 'million', '100-500 People', '10+', '<P><FONT face=Arial color=#993399 size=2><STRONG><FONT color=#990000>Company History</FONT></STRONG><BR><FONT color=#333333>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></FONT></P><FONT face=Arial color=#333333 size=2>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG></STRONG></FONT>&nbsp;</P>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG>Current Status</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#003300 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL>\r\n<P><FONT face=Arial color=#660000 size=2><STRONG>Future Plans</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#333333 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL></FONT>', '72378736.gif', 'www.domain.com', 0, 'yes', 20040706185354, 20040706180956, 'yes'),
(4, 5, 'Softbiz Solutions', 1, 'Punjab', 89, 8, '10-100', 2, 'million', '25-100 People', '10+', '<P><FONT face=Arial color=#993399 size=2><STRONG><FONT color=#990000>Company History</FONT></STRONG><BR><FONT color=#333333>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></FONT></P><FONT face=Arial color=#333333 size=2>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG></STRONG></FONT>&nbsp;</P>\r\n<P><FONT face=Arial color=#006600 size=2><STRONG>Current Status</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#003300><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#003300 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL>\r\n<P><FONT face=Arial color=#660000 size=2><STRONG>Future Plans</STRONG></FONT></P>\r\n<UL>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT color=#333333><FONT face=Arial size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT> </FONT>\r\n<LI><FONT face=Arial color=#333333 size=2>Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..Company Profile here ..</FONT></LI></UL></FONT>', '93984012.gif', 'www.domain.com', 0, 'yes', 20040707083925, 20040706180956, 'yes');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_config`
#

DROP TABLE IF EXISTS `sbjbs_config`;
CREATE TABLE `sbjbs_config` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_admin_email` varchar(255) default NULL,
  `sb_site_name` varchar(255) default NULL,
  `sb_site_root` varchar(255) default NULL,
  `sb_style_list` bigint(20) default NULL,
  `sb_recperpage` int(11) default '10',
  `sb_icon_list` bigint(20) default NULL,
  `sb_date_format` bigint(20) default '2',
  `sb_time_format` bigint(20) default '2',
  `sb_mem_approval` varchar(255) default 'auto',
  `sb_profile_approval` varchar(255) default 'admin',
  `sb_resume_approval` varchar(255) default 'admin',
  `sb_job_approval` varchar(255) NOT NULL default 'admin',
  `sb_premium_approval` varchar(255) NOT NULL default 'admin',
  `sb_letter_approval` varchar(255) default 'admin',
  `sb_null_char` varchar(255) default '- -',
  `sb_signup_verification` varchar(255) default 'yes',
  `sb_logo` varchar(255) default NULL,
  `sb_site_keywords` varchar(255) default NULL,
  `sbcomp_cat_cnt` bigint(20) NOT NULL default '1',
  `sb_image_size` bigint(20) NOT NULL default '6000',
  `sb_title_len` int(11) default '70',
  `sb_job_desc_len` bigint(20) NOT NULL default '1000',
  `sb_resume_desc_len` int(11) default '2000',
  `sb_cover_letter_len` int(11) default '4000',
  `sb_job_cnt` bigint(20) NOT NULL default '1',
  `sb_resume_cnt` int(11) default '5',
  `sb_company_cnt` int(11) default '1',
  `sb_letter_cnt` int(11) default '5',
  `sb_fee_symbol` varchar(255) default NULL,
  `sb_fee_code` varchar(255) default NULL,
  `sb_premium_fee` double(10,2) NOT NULL default '0.00',
  `sb_job_fee` decimal(10,2) NOT NULL default '0.00',
  `sb_job_fee_additional` decimal(10,2) NOT NULL default '0.00',
  `sb_front_featured_fee` decimal(10,2) NOT NULL default '0.00',
  `sb_featured_fee` decimal(10,2) NOT NULL default '0.00',
  `sb_highlight_fee` decimal(10,2) NOT NULL default '0.00',
  `sb_bold_fee` decimal(10,2) NOT NULL default '0.00',
  `sb_premium_cnt` bigint(20) default '10',
  `sb_featured_cnt` int(11) default '5',
  `last_sent` bigint(14) default NULL,
  `sb_cat_listing` varchar(255) default 'alpha',
  `sb_paypal_id` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_config`
#

INSERT INTO `sbjbs_config` (`sb_id`, `sb_admin_email`, `sb_site_name`, `sb_site_root`, `sb_style_list`, `sb_recperpage`, `sb_icon_list`, `sb_date_format`, `sb_time_format`, `sb_mem_approval`, `sb_profile_approval`, `sb_resume_approval`, `sb_job_approval`, `sb_premium_approval`, `sb_letter_approval`, `sb_null_char`, `sb_signup_verification`, `sb_logo`, `sb_site_keywords`, `sbcomp_cat_cnt`, `sb_image_size`, `sb_title_len`, `sb_job_desc_len`, `sb_resume_desc_len`, `sb_cover_letter_len`, `sb_job_cnt`, `sb_resume_cnt`, `sb_company_cnt`, `sb_letter_cnt`, `sb_fee_symbol`, `sb_fee_code`, `sb_premium_fee`, `sb_job_fee`, `sb_job_fee_additional`, `sb_front_featured_fee`, `sb_featured_fee`, `sb_highlight_fee`, `sb_bold_fee`, `sb_premium_cnt`, `sb_featured_cnt`, `last_sent`, `sb_cat_listing`, `sb_paypal_id`) VALUES (1, 'admin@sbjobseekers.com', 'Jobs & Recruitment Script - Softbiz', 'http://www.domain.com/scripts/jobs', 18, 10, 2, 9, 2, 'auto', 'auto', 'admin', 'auto', 'auto', 'auto', '- -', 'no', '95569274.gif', 'jobs,resumes,career', 2, 60000, 50, 4000, 3000, 3500, 9, 5, 5, 5, '$', 'USD', '10.00', '5.00', '10.00', '15.00', '10.00', '8.00', '6.00', 2, 5, 20040827, 'alpha', 'admin@domain.com');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_country`
#

DROP TABLE IF EXISTS `sbjbs_country`;
CREATE TABLE `sbjbs_country` (
  `country` varchar(255) NOT NULL default '',
  `id` bigint(20) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_country`
#

INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Afghanistan', 1),
('Albania', 2),
('Algeria', 3),
('Andorra', 4),
('Angola', 5),
('Anguilla', 6),
('Antigua & Barbuda', 7),
('Argentina', 8),
('Armenia', 9),
('Austria', 10),
('Azerbaijan', 11),
('Bahamas', 12),
('Bahrain', 13),
('Bangladesh', 14),
('Barbados', 15),
('Belarus', 16),
('Belgium', 17),
('Belize', 18),
('Belize', 19),
('Bermuda', 20),
('Bhutan', 21),
('Bolivia', 22),
('Bosnia and Herzegovina', 23),
('Botswana', 24),
('Brazil', 25),
('Brunei', 26),
('Bulgaria', 27),
('Burkina Faso', 28),
('Burundi', 29),
('Cambodia', 30),
('Cameroon', 31),
('Canada', 32),
('Cape Verde', 33),
('Cayman Islands', 34),
('Central African Republic', 35),
('Chad', 36),
('Chile', 37),
('China', 38),
('Colombia', 39),
('Comoros', 40),
('Congo', 41),
('Congo (DRC)', 42),
('Cook Islands', 43),
('Costa Rica', 44),
('Cote d\'Ivoire', 45),
('Croatia (Hrvatska)', 46),
('Cuba', 47),
('Cyprus', 48),
('Czech Republic', 49),
('Denmark', 50),
('Djibouti', 51),
('Dominica', 52),
('Dominican Republic', 53),
('East Timor', 54),
('Ecuador', 55),
('Egypt', 56),
('El Salvador', 57),
('Equatorial Guinea', 58),
('Eritrea', 59),
('Estonia', 60),
('Ethiopia', 61),
('Falkland Islands', 62),
('Faroe Islands', 63),
('Fiji Islands', 64),
('Finland', 65),
('France', 66),
('French Guiana', 67),
('French Polynesia', 68),
('Gabon', 69),
('Gambia', 70),
('Georgia', 71),
('Germany', 72),
('Ghana', 73),
('Gibraltar', 74),
('Greece', 75),
('Greenland', 76),
('Grenada', 77),
('Guadeloupe', 78),
('Guam', 79),
('Guatemala', 80),
('Guinea', 81),
('Guinea-Bissau', 82),
('Guyana', 83),
('Haiti', 84),
('Honduras', 85),
('Hong Kong SAR', 86),
('Hungary', 87),
('Iceland', 88),
('India', 89),
('Indonesia', 90),
('Iran', 91),
('Iraq', 92),
('Ireland', 93),
('Israel', 94),
('Italy', 95),
('Jamaica', 96),
('Japan', 97),
('Jordan', 98),
('Kazakhstan', 99),
('Kenya', 100),
('Kiribati', 101),
('Korea', 102),
('Kuwait', 103),
('Kyrgyzstan', 104),
('Laos', 105),
('Latvia', 106),
('Lebanon', 107),
('Lesotho', 108),
('Liberia', 109),
('Libya', 110),
('Liechtenstein', 111),
('Lithuania', 112),
('Luxembourg', 113),
('Macao SAR', 114),
('Macedonia', 115),
('Madagascar', 116),
('Malawi', 117),
('Malaysia', 118),
('Maldives', 119),
('Mali', 120),
('Malta', 121),
('Martinique', 122),
('Mauritania', 123),
('Mauritius', 124),
('Mayotte', 125),
('Mexico', 126),
('Micronesia', 127),
('Moldova', 128),
('Monaco', 129),
('Mongolia', 130),
('Montserrat', 131),
('Morocco', 132),
('Mozambique', 133),
('Myanmar', 134),
('Namibia', 135),
('Nauru', 136),
('Nepal', 137),
('Netherlands', 138),
('Netherlands Antilles', 139),
('New Caledonia', 140),
('New Zealand', 141),
('Nicaragua', 142),
('Niger', 143),
('Nigeria', 144),
('Niue', 145),
('Norfolk Island', 146),
('North Korea', 147),
('Norway', 148),
('Oman', 149),
('Pakistan', 150),
('Panama', 151),
('Papua New Guinea', 152),
('Paraguay', 153),
('Peru', 154),
('Philippines', 155),
('Pitcairn Islands', 156),
('Poland', 157),
('Portugal', 158),
('Puerto Rico', 159),
('Qatar', 160),
('Reunion', 161),
('Romania', 162),
('Russia', 163),
('Rwanda', 164),
('Samoa', 165),
('San Marino', 166),
('Sao Tome and Principe', 167),
('Saudi Arabia', 168),
('Senegal', 169),
('Serbia and Montenegro', 170),
('Seychelles', 171),
('Sierra Leone', 172),
('Singapore', 173),
('Slovakia', 174),
('Slovenia', 175),
('Solomon Islands', 176),
('Somalia', 177),
('South Africa', 178),
('Spain', 179),
('Sri Lanka', 180),
('St. Helena', 181),
('St. Kitts and Nevis', 182),
('St. Lucia', 183),
('St. Pierre and Miquelon', 184),
('St. Vincent & Grenadines', 185),
('Sudan', 186),
('Suriname', 187),
('Swaziland', 188),
('Sweden', 189),
('Switzerland', 190),
('Syria', 191),
('Taiwan', 192),
('Tajikistan', 193),
('Tanzania', 194),
('Thailand', 195),
('Togo', 196),
('Tokelau', 197),
('Tonga', 198),
('Trinidad and Tobago', 199),
('Tunisia', 200),
('Turkey', 201),
('Turkmenistan', 202),
('Turks and Caicos Islands', 203),
('Tuvalu', 204),
('Uganda', 205),
('Ukraine', 206),
('United Arab Emirates', 207),
('United Kingdom', 208),
('Uruguay', 209),
('USA', 210),
('Uzbekistan', 211),
('Vanuatu', 212),
('Venezuela', 213),
('Vietnam', 214),
('Virgin Islands', 215),
('Virgin Islands (British)', 216),
('Wallis and Futuna', 217),
('Yemen', 218),
('Yugoslavia', 219),
('Zambia', 220),
('Zimbabwe', 221),
('Australia', 222);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_cover_letters`
#

DROP TABLE IF EXISTS `sbjbs_cover_letters`;
CREATE TABLE `sbjbs_cover_letters` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_seeker_id` bigint(20) default NULL,
  `sb_title` varchar(255) default NULL,
  `sb_contents` longtext,
  `sb_approved` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_cover_letters`
#

INSERT INTO `sbjbs_cover_letters` (`sb_id`, `sb_seeker_id`, `sb_title`, `sb_contents`, `sb_approved`) VALUES (11, 3, 'mine cover letter title 4 mine cover letter title 4', 'To\r\n	The principle,\r\n	Govt. Sr. sec. School,\r\n	Shahpur Kandi.\r\n\r\nRespected Madam,\r\n		\r\n		This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. \r\n		\r\n		\r\n	This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. \r\n\r\n	Thank\'in U.\r\n\r\n					Urs Obediently\r\nDated:June 16, 2004			Harry Singh\r\n					Roll # 3122\r\n					8th-A\r\n', 'yes'),
(41, 12, 'assasas', 'assasasas saas saasasasas  saasasas  sasaas asasasas as sasa sas as as asasasasas  asas a sas as asas as asas', 'new'),
(15, 3, 'cover letter title2 mine cover letter title211', ' mine cover letter contents2  ', 'yes'),
(40, 12, 'vin cover letter2', 'To\r\n%DESIGNATION%\r\n%COMPANY ADDRESS%\r\n\r\nRespected Sir/Madam,\r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here\r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here \r\n\r\nThanking You, \r\nWith Regards,\r\n%your name%,\r\n%your address%,\r\n%your email%. \r\n\r\nDated: %date here% \r\n\r\n', 'yes'),
(39, 12, 'vin cover letter', 'To\r\n%DESIGNATION%\r\n%COMPANY ADDRESS%\r\n\r\nRespected Sir/Madam,\r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here\r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here \r\n\r\nThanking You, \r\nWith Regards,\r\n%your name%,\r\n%your address%,\r\n%your email%. \r\n\r\nDated: %date here% \r\n\r\n', 'yes'),
(22, 3, 'mine cover letter', 'To to\r\n	The principle,\r\n	Govt. Sr. sec. School,\r\n	Shahpur Kandi.\r\n\r\nRespected Madam,\r\n		\r\n		This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. \r\n		\r\n		\r\n	This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. This is certified that \'am a student of 8th-A class bearing roll no. 3122. \r\n\r\n	Thank\'in U.\r\n\r\n					Urs Obediently\r\nDated:June 16, 2004			Harry Singh\r\n					Roll # 3122\r\n					8th-A\r\n', 'new'),
(44, 10, 'My Cover Letter', 'Respected Sir/Madam,\r\n\r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here \r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here \r\n\r\nThanking You,\r\n\r\nWith Regards,\r\nEvita Singla\r\nabc@abc.com\r\n', 'yes'),
(30, 10, 'Official cover letter', 'Respected Sir/Madam,\r\n\r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here \r\nLetter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here Letter Contents Here \r\n\r\nThanking You,\r\n\r\nWith Regards,\r\nEvita Singla\r\nabc@abc.com\r\n', 'yes');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_currencies`
#

DROP TABLE IF EXISTS `sbjbs_currencies`;
CREATE TABLE `sbjbs_currencies` (
  `sbcur_id` bigint(20) NOT NULL auto_increment,
  `sbcur_symbol` varchar(255) default NULL,
  `sbcur_name` varchar(255) default NULL,
  PRIMARY KEY  (`sbcur_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_currencies`
#

INSERT INTO `sbjbs_currencies` (`sbcur_id`, `sbcur_symbol`, `sbcur_name`) VALUES (2, 'Rs.', 'INR'),
(3, '&pound;', 'GBP'),
(4, '$', 'AUD'),
(5, '$', 'CAD'),
(8, '$', 'USD');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_dateformats`
#

DROP TABLE IF EXISTS `sbjbs_dateformats`;
CREATE TABLE `sbjbs_dateformats` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_format` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_dateformats`
#

INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (1, '2004-06-29'),
(2, '06-29-2004'),
(3, '29-06-2004'),
(4, '29 Jun 2004'),
(5, '29 June 2004'),
(6, 'Jun 29th,2004'),
(7, 'Tue Jun 29th,2004'),
(8, 'Tuesday Jun 29th,2004'),
(9, 'Tuesday June 29th,2004'),
(10, '29 June 2004 Tuesday');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_degrees`
#

DROP TABLE IF EXISTS `sbjbs_degrees`;
CREATE TABLE `sbjbs_degrees` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_degree` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_degrees`
#

INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (1, 'High School or Equivalent (12th, Intermediate, Jr College)'),
(2, 'Certification (Diploma)'),
(3, 'Vocational (Diploma)'),
(4, 'Some Tertiary Coursework Completed'),
(5, 'Associates Degree'),
(6, 'Bachelor\'s Degree-Graduate Degree (BA, BSc, BCom)'),
(7, 'Master\'s Degree-Post Graduate (MA, MSc, MComm, LLB)'),
(8, 'Doctorate'),
(9, 'Professional-Engineering(BE or BTech)');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_education`
#

DROP TABLE IF EXISTS `sbjbs_education`;
CREATE TABLE `sbjbs_education` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_resume_id` bigint(20) NOT NULL default '0',
  `sb_school` varchar(255) default NULL,
  `sb_end_month` int(11) default NULL,
  `sb_end_year` int(11) default NULL,
  `sb_degree` varchar(255) default NULL,
  `sb_city` varchar(255) default NULL,
  `sb_state` varchar(255) default NULL,
  `sb_country` bigint(20) default NULL,
  `sb_desc` longtext,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_education`
#

INSERT INTO `sbjbs_education` (`sb_id`, `sb_resume_id`, `sb_school`, `sb_end_month`, `sb_end_year`, `sb_degree`, `sb_city`, `sb_state`, `sb_country`, `sb_desc`) VALUES (34, 49, 'Institute of Engg. and Tech.', 7, 2002, 'Professional-Engineering(BE or BTech)', 'Chd.', 'Chd.', 89, 'University Topper'),
(35, 49, 'ABC Institute of Management', 7, 2004, 'Master\'s Degree-Post Graduate (MA, MSc, MComm, LLB)', 'Del', 'Del', 89, 'Got first prize in 3rd semmester \r\n'),
(36, 50, 'Institute of Engg. and Tech.', 7, 2002, 'Professional-Engineering(BE or BTech)', 'Chd.', 'Chd.', 89, 'University Topper'),
(37, 50, 'ABC Institute of Management', 7, 2004, 'Master\'s Degree-Post Graduate (MA, MSc, MComm, LLB)', 'Del', 'Del', 89, 'Got first prize in 3rd semmester \r\n'),
(29, 45, 'Institute of Engg. and Tech.', 7, 2002, 'Professional-Engineering(BE or BTech)', 'Chd.', 'Chd.', 89, 'University Topper'),
(30, 45, 'ABC Institute of Management', 7, 2004, 'Master\'s Degree-Post Graduate (MA, MSc, MComm, LLB)', 'Del', 'Del', 89, 'Got first prize in 3rd semmester \r\n');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_emp_online`
#

DROP TABLE IF EXISTS `sbjbs_emp_online`;
CREATE TABLE `sbjbs_emp_online` (
  `sb_ip` varchar(255) NOT NULL default '',
  `sb_ontime` timestamp(14) NOT NULL,
  `sb_uid` bigint(20) default '0'
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_emp_online`
#

INSERT INTO `sbjbs_emp_online` (`sb_ip`, `sb_ontime`, `sb_uid`) VALUES ('169.254.61.14', 20001226192517, -1);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_emp_signups`
#

DROP TABLE IF EXISTS `sbjbs_emp_signups`;
CREATE TABLE `sbjbs_emp_signups` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_rnum` varchar(255) default '',
  `sb_email` varchar(255) default '',
  `sb_onstamp` timestamp(14) NOT NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_emp_signups`
#

INSERT INTO `sbjbs_emp_signups` (`sb_id`, `sb_rnum`, `sb_email`, `sb_onstamp`) VALUES (1, '515457531', 'hey@h.com', 20040611103611);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_employers`
#

DROP TABLE IF EXISTS `sbjbs_employers`;
CREATE TABLE `sbjbs_employers` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_username` varchar(255) default NULL,
  `sb_password` varchar(255) default NULL,
  `sb_title` varchar(255) default NULL,
  `sb_firstname` varchar(255) default NULL,
  `sb_lastname` varchar(255) default NULL,
  `sb_addr1` varchar(255) default NULL,
  `sb_addr2` varchar(255) default NULL,
  `sb_city` varchar(255) default NULL,
  `sb_state` varchar(255) default NULL,
  `sb_zip` varchar(255) default NULL,
  `sb_country` bigint(20) NOT NULL default '-1',
  `sb_telephone` varchar(255) default NULL,
  `sb_mobile` varchar(255) default NULL,
  `sb_email_addr` varchar(255) default NULL,
  `sbtemp` timestamp(14) NOT NULL,
  `sb_last_login` timestamp(14) NOT NULL,
  `sb_signup_on` timestamp(14) NOT NULL,
  `sb_suspended` varchar(255) default NULL,
  `sb_search_allowed` varchar(255) NOT NULL default 'no',
  `sb_search_expiry` timestamp(14) NOT NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_employers`
#

INSERT INTO `sbjbs_employers` (`sb_id`, `sb_username`, `sb_password`, `sb_title`, `sb_firstname`, `sb_lastname`, `sb_addr1`, `sb_addr2`, `sb_city`, `sb_state`, `sb_zip`, `sb_country`, `sb_telephone`, `sb_mobile`, `sb_email_addr`, `sbtemp`, `sb_last_login`, `sb_signup_on`, `sb_suspended`, `sb_search_allowed`, `sb_search_expiry`) VALUES (10, 'vvv', 'vvv', 'Mr.', 'vv', 'vv', 'vv', NULL, 'vv', 'vv', 'vv', 212, '--', '', 'vikk@vik.com', 20040708123652, 20040708123652, 20040625183600, 'no', 'no', 00000000000000),
(4, 'john', 'a', 'Ms.', 'John', 'Player', '#141 MS Strt', NULL, 'CZ', 'Georgia', '1234567', 210, '001-11-11', '445566', 'e_mine@m.com', 20040707113921, 20040707113921, 20040611122638, 'no', 'no', 20040705124805),
(5, 'demo', 'demo', 'Ms.', 'vita', 'sharma', '121, Strt abc', NULL, 'fgh', 'Illinois', '11111111', 89, '--', '', 'e_micx@m.com', 20040826154524, 20040826154524, 20040612102828, 'no', 'no', 20040720102142),
(6, 'test', 'a', 'Mr.', 'test', 'test', 'test st', NULL, 'test ci', 'Idaho', '123456', 210, '--', '', 'test@t.com', 20040716113406, 20040716113406, 20040612112118, 'no', 'no', 20040625180541),
(9, 'e_tina', 'a', 'Ms.', 'mine1', 'kaur1', 'st mine1', NULL, 'ci mine1', 'pb', '148106', 89, '11-22-33', '445566', 'e_mine@m.com', 20040706143725, 20040625181827, 20040611122638, 'no', 'no', 20040629124805),
(14, 'e_admtest', 'a\'', 'Ms.', 'e_admtest  fn', 'e_admtest ln', 'e_admtest  st', NULL, 'e_admtest ci', 'e_admtest state', 'e_admtest zip', 2, '88-77-66', '55', 'e_admtest@m.com', 20040706090446, 00000000000000, 20040706084518, 'no', 'no', 00000000000000),
(13, 'e_test', 'a', 'Mr.', 'f e_test', 'l e_test', 'st', NULL, 'ci', 'Alaska', '454', 2, '77-88-55', '33', 'e_test@t.com', 20040825135002, 20040706155730, 20040705091809, 'no', 'no', 20040717154508);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_experience`
#

DROP TABLE IF EXISTS `sbjbs_experience`;
CREATE TABLE `sbjbs_experience` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_resume_id` bigint(20) NOT NULL default '0',
  `sb_start_month` int(11) default NULL,
  `sb_end_month` int(11) default NULL,
  `sb_start_year` int(11) default NULL,
  `sb_end_year` int(11) default NULL,
  `sb_company_name` varchar(255) default NULL,
  `sb_location` varchar(255) default NULL,
  `sb_designation` varchar(255) default NULL,
  `sb_work_desc` longtext,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_experience`
#

INSERT INTO `sbjbs_experience` (`sb_id`, `sb_resume_id`, `sb_start_month`, `sb_end_month`, `sb_start_year`, `sb_end_year`, `sb_company_name`, `sb_location`, `sb_designation`, `sb_work_desc`) VALUES (66, 50, 1, 13, 2003, 2004, 'SoftBiz', 'LDH', 'Senior Programmer', '.Developing Web scripts using PHP/MySql.\r\n.Analysing Basic Programming structure.\r\n\r\n'),
(65, 50, 3, 1, 2002, 2003, 'ES Solutions', 'Delhi', 'Application Programmer', '.Developing applications using C/C++.\r\n.Analysing Basic Programming Structure.'),
(63, 49, 3, 1, 2002, 2003, 'ES Solutions', 'Delhi', 'Application Programmer', '.Developing applications using C/C++.\r\n.Analysing Basic Programming Structure.'),
(64, 49, 1, 13, 2003, 2004, 'SoftBiz', 'LDH', 'Senior Programmer', '.Developing Web scripts using PHP/MySql.\r\n.Analysing Basic Programming structure.\r\n\r\n'),
(58, 45, 3, 1, 2002, 2003, 'ES Solutions', 'Delhi', 'Application Programmer', '.Developing applications using C/C++.\r\n.Analysing Basic Programming Structure.'),
(59, 45, 1, 13, 2003, 2004, 'SoftBiz', 'LDH', 'Senior Programmer', '.Developing Web scripts using PHP/MySql.\r\n.Analysing Basic Programming structure.\r\n\r\n');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_feedback`
#

DROP TABLE IF EXISTS `sbjbs_feedback`;
CREATE TABLE `sbjbs_feedback` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_fname` varchar(255) default NULL,
  `sb_lname` varchar(255) default NULL,
  `sb_email` varchar(255) default NULL,
  `sb_url` varchar(255) default NULL,
  `sb_title` varchar(255) default NULL,
  `sb_comments` longtext,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_feedback`
#

INSERT INTO `sbjbs_feedback` (`sb_id`, `sb_fname`, `sb_lname`, `sb_email`, `sb_url`, `sb_title`, `sb_comments`) VALUES (4, 'kk', 'hh', 'h@h.com', 'hh', 'h', 'h');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_icons`
#

DROP TABLE IF EXISTS `sbjbs_icons`;
CREATE TABLE `sbjbs_icons` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_title` varchar(255) default NULL,
  `sb_mem_opt` varchar(255) default NULL,
  `sb_apply_now` varchar(255) default NULL,
  `sb_join_now` varchar(255) default NULL,
  `sb_refer_friend` varchar(255) default NULL,
  `sb_profile` varchar(255) default NULL,
  `sb_bar` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_icons`
#

INSERT INTO `sbjbs_icons` (`sb_id`, `sb_title`, `sb_mem_opt`, `sb_apply_now`, `sb_join_now`, `sb_refer_friend`, `sb_profile`, `sb_bar`) VALUES (2, 'Job Seeker Scheme', '55150225.gif', '9689396.gif', '30730391.gif', '14372198.gif', '8281744.gif', '59114671.gif');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_industries`
#

DROP TABLE IF EXISTS `sbjbs_industries`;
CREATE TABLE `sbjbs_industries` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_name` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_industries`
#

INSERT INTO `sbjbs_industries` (`sb_id`, `sb_name`) VALUES (1, 'Advertising'),
(2, 'Agriculture/'),
(3, 'Airlines'),
(4, 'Automotive'),
(5, 'Banking/ Financial'),
(6, 'Bio Technology'),
(7, 'Chemicals/ Plastic/ Polymers'),
(8, 'IT/ Computers - Softwares'),
(9, 'Computers Hardware');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_job_cats`
#

DROP TABLE IF EXISTS `sbjbs_job_cats`;
CREATE TABLE `sbjbs_job_cats` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_cid` bigint(20) default NULL,
  `sb_job_id` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_job_cats`
#

INSERT INTO `sbjbs_job_cats` (`sb_id`, `sb_cid`, `sb_job_id`) VALUES (1, 14, 25),
(2, 15, 25),
(3, 14, 26),
(4, 13, 26),
(228, 8, 19),
(225, 28, 49),
(224, 1, 1),
(19, 15, 35),
(226, 5, 20),
(223, 42, 1),
(222, 6, 22),
(221, 5, 22),
(215, 5, 28),
(227, 5, 19),
(213, 38, 42);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_job_locs`
#

DROP TABLE IF EXISTS `sbjbs_job_locs`;
CREATE TABLE `sbjbs_job_locs` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_lid` bigint(20) default NULL,
  `sb_job_id` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_job_locs`
#

INSERT INTO `sbjbs_job_locs` (`sb_id`, `sb_lid`, `sb_job_id`) VALUES (178, 5, 1),
(177, 4, 1),
(184, 17, 19),
(183, 23, 20),
(185, 23, 19),
(171, 8, 28),
(179, 8, 49),
(176, 17, 1),
(170, 1, 28),
(165, 5, 42),
(182, 12, 20),
(181, 11, 20),
(180, 17, 20),
(175, 17, 22),
(169, 9, 28),
(164, 1, 42),
(174, 10, 22);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_job_skls`
#

DROP TABLE IF EXISTS `sbjbs_job_skls`;
CREATE TABLE `sbjbs_job_skls` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_sid` bigint(20) default NULL,
  `sb_job_id` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_job_skls`
#

INSERT INTO `sbjbs_job_skls` (`sb_id`, `sb_sid`, `sb_job_id`) VALUES (114, 5, 19),
(112, 3, 20),
(111, 2, 20),
(106, 5, 28),
(105, 2, 28),
(113, 3, 19),
(102, 3, 42),
(109, 5, 1),
(108, 3, 22),
(110, 3, 49);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_jobs`
#

DROP TABLE IF EXISTS `sbjbs_jobs`;
CREATE TABLE `sbjbs_jobs` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_uid` bigint(20) NOT NULL default '0',
  `sb_title` varchar(255) default NULL,
  `sb_role` varchar(255) default NULL,
  `sb_company_id` bigint(20) NOT NULL default '0',
  `sb_vacancies` bigint(20) NOT NULL default '0',
  `sbtemp` timestamp(14) NOT NULL,
  `sb_posted_on` timestamp(14) NOT NULL,
  `sb_experience` bigint(20) default NULL,
  `sb_education` varchar(255) default NULL,
  `sb_min_salary` decimal(15,2) NOT NULL default '0.00',
  `sb_max_salary` decimal(15,2) NOT NULL default '0.00',
  `sb_currency` bigint(20) NOT NULL default '0',
  `sb_salary_type` bigint(20) default NULL,
  `sb_description` longtext,
  `sb_approved` varchar(255) default NULL,
  `sb_career_level` varchar(255) default NULL,
  `sb_job_type` bigint(20) NOT NULL default '0',
  `sb_job_status` bigint(20) NOT NULL default '0',
  `sb_show_profile1` varchar(255) default NULL,
  `sb_front_featured` varchar(255) NOT NULL default 'no',
  `sb_featured` varchar(255) NOT NULL default 'no',
  `sb_highlight` varchar(255) NOT NULL default 'no',
  `sb_bold` varchar(255) NOT NULL default 'no',
  `sb_cat_count` int(11) NOT NULL default '0',
  `sb_loc_count` int(11) NOT NULL default '0',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_jobs`
#

INSERT INTO `sbjbs_jobs` (`sb_id`, `sb_uid`, `sb_title`, `sb_role`, `sb_company_id`, `sb_vacancies`, `sbtemp`, `sb_posted_on`, `sb_experience`, `sb_education`, `sb_min_salary`, `sb_max_salary`, `sb_currency`, `sb_salary_type`, `sb_description`, `sb_approved`, `sb_career_level`, `sb_job_type`, `sb_job_status`, `sb_show_profile1`, `sb_front_featured`, `sb_featured`, `sb_highlight`, `sb_bold`, `sb_cat_count`, `sb_loc_count`) VALUES (1, 4, 'Programme Officers', 'Administrative Responsibilities', 2, 5, 20040706183335, 20040614160643, 7, '8', '0.00', '0.00', 2, 2, 'Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here .\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..', 'yes', '7', 1, 1, 'yes', 'yes', 'yes', 'yes', 'yes', 2, 3),
(19, 5, 'Graphics Designer', 'Graphics Designer', 4, 2, 20040706190812, 20040615155119, -1, '0', '0.00', '0.00', 0, 0, 'Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here \r\nGraphicks Designer job description here Graphicks Designer job description here \r\n\r\nGraphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here Graphicks Designer job description here ', 'yes', '3', 1, 3, 'no', 'no', 'no', 'no', 'no', 2, 2),
(20, 5, 'Web Developer', 'Web Developer', 4, 5, 20040706185938, 20040615155509, 2, '9', '0.00', '0.00', 0, 0, 'Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here \r\n\r\nWeb Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here \r\n\r\nWeb Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here Web Developer job description here ', 'yes', '3', 1, 1, 'no', 'no', 'no', 'no', 'no', 5, 4),
(22, 4, 'Programmers', 'Developers And Analysts', 2, 10, 20040706182928, 20040615164343, 1, '9', '0.00', '0.00', 0, 0, 'Job Description here .. Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..', 'yes', '4', 5, 3, 'no', 'yes', 'yes', 'no', 'no', 5, 2),
(28, 4, 'Sr. Programmer', 'Team Leader', 1, 200, 20040706174802, 20040622165849, 4, '9', '0.00', '0.00', 0, 0, 'We needs Sr. Programmers for its new branches to be opened up in Mumbai and Bangalore. \r\n\r\nSr. Programmers will co-ordinate programmers, analysts team - including recruitment, training and delivering on mile stone in project life cycle. \r\n\r\nWe needs Sr. Programmers for its new branches to be opened up in Mumbai and Bangalore. \r\n\r\nSr. Programmers will co-ordinate programmers, analysts team - including recruitment, training and delivering on mile stone in project life cycle. \r\n\r\n\r\nWe needs Sr. Programmers for its new branches to be opened up in Mumbai and Bangalore. \r\n\r\nSr. Programmers will co-ordinate programmers, analysts team - including recruitment, training and delivering on mile stone in project life cycle. \r\n\r\n\r\n\r\nAbout Us: \r\n\r\nWe are the world\'s largest online community - serving NRIs for the past 6 years in 30 American cities. \r\nWe are the world\'s largest online community - serving NRIs for the past 6 years in 30 American cities. \r\nWe are the world\'s largest online community - serving NRIs for the past 6 years in 30 American cities. ', 'yes', '4', 7, 1, 'no', 'yes', 'yes', 'yes', 'yes', 6, 4),
(42, 4, 'Chief Medical Officer', 'Chief Medical Officer', 1, 50, 20040706173904, 20040624181632, 5, '8', '65000.00', '75000.00', 2, 2, 'Person must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful...  \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful...  \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful...  \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... \r\nPerson must be able to handle a charitable hospital for it\'s success in the area and provides the medical help to needful... ', 'yes', '5', 1, 1, NULL, 'yes', 'yes', 'no', 'no', 7, 11),
(49, 5, 'Chief Accountant', 'Audition/ Account Management', 3, 20, 20040706185602, 20040706101554, 4, '7', '0.00', '0.00', 0, 0, 'Job Description here ..Job Description here ..Job Description here ..Job Description here ..\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..Job Description here ..\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..\r\n\r\nJob Description here ..Job Description here ..Job Description here ..Job Description here ..', 'yes', '5', 1, 1, NULL, 'no', 'no', 'no', 'no', 1, 1);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_languages`
#

DROP TABLE IF EXISTS `sbjbs_languages`;
CREATE TABLE `sbjbs_languages` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_name` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_languages`
#

INSERT INTO `sbjbs_languages` (`sb_id`, `sb_name`) VALUES (7, 'English'),
(2, 'Hindi'),
(3, 'Punjabi'),
(4, 'Urdu');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_levels`
#

DROP TABLE IF EXISTS `sbjbs_levels`;
CREATE TABLE `sbjbs_levels` (
  `sb_id` tinyint(4) NOT NULL auto_increment,
  `sb_levelid` tinyint(4) NOT NULL default '0',
  `sb_levelname` varchar(25) NOT NULL default '',
  `sblevel_text` longtext,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_levels`
#

INSERT INTO `sbjbs_levels` (`sb_id`, `sb_levelid`, `sb_levelname`, `sblevel_text`) VALUES (1, 1, 'Gold', 'Gold Mebers can ....'),
(2, 2, 'Silver', 'Silver Members can ...'),
(3, 3, 'Bronze', 'Bronze Members can ...');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_locations`
#

DROP TABLE IF EXISTS `sbjbs_locations`;
CREATE TABLE `sbjbs_locations` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_loc_name` varchar(255) default NULL,
  `sb_pid` bigint(20) default NULL,
  `sb_default` int(11) default '0',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_locations`
#

INSERT INTO `sbjbs_locations` (`sb_id`, `sb_loc_name`, `sb_pid`, `sb_default`) VALUES (1, 'UK', 0, 0),
(4, 'London', 1, 0),
(5, 'Manchester', 1, 0),
(8, 'USA', 0, 1),
(9, 'Australia', 0, 0),
(10, 'Arizona', 8, 0),
(11, 'Sydney', 9, 0),
(12, 'New Hampshire', 8, 0),
(13, 'Alabama', 8, 0),
(14, 'Alaska', 8, 0),
(16, 'Arkansas', 8, 0),
(17, 'California', 8, 0),
(18, 'Colorado', 8, 0),
(19, 'Connecticut', 8, 0),
(20, 'Delaware', 8, 0),
(21, 'Florida', 8, 0),
(22, 'Georgia', 8, 0),
(23, 'Hawaii', 8, 0),
(24, 'Idaho', 8, 0),
(25, 'Illinois', 8, 0),
(26, 'Indiana', 8, 0),
(27, 'Iowa', 8, 0),
(28, 'Kansas', 8, 0),
(29, 'Kentucky', 8, 0),
(30, 'Louisiana', 8, 0),
(31, 'Maine', 8, 0),
(32, 'Maryland', 8, 0),
(33, 'Massachusetts', 8, 0),
(34, 'Michigan', 8, 0),
(35, 'Minnesota', 8, 0),
(36, 'Mississippi', 8, 0),
(37, 'Missouri', 8, 0),
(38, 'Montana', 8, 0),
(39, 'Nebraska', 8, 0),
(40, 'Nevada', 8, 0),
(64, 'Perth', 9, 0),
(42, 'New Jersey', 8, 0),
(43, 'New Mexico', 8, 0),
(44, 'New York', 8, 0),
(45, 'North Carolina', 8, 0),
(46, 'North Dakota', 8, 0),
(47, 'Ohio', 8, 0),
(48, 'Oklahoma', 8, 0),
(49, 'Oregon', 8, 0),
(50, 'Pennsylvania', 8, 0),
(51, 'Rhode Island', 8, 0),
(52, 'South Carolina', 8, 0),
(53, 'South Dakota', 8, 0),
(54, 'Tennessee', 8, 0),
(55, 'Texas', 8, 0),
(56, 'Utah', 8, 0),
(57, 'Vermont', 8, 0),
(58, 'Virginia', 8, 0),
(59, 'Washington', 8, 0),
(60, 'Washington DC', 8, 0),
(61, 'West Virginia', 8, 0),
(62, 'Wisconsin', 8, 0),
(63, 'Wyoming', 8, 0);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_mailalert_set`
#

DROP TABLE IF EXISTS `sbjbs_mailalert_set`;
CREATE TABLE `sbjbs_mailalert_set` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_uid` bigint(20) default NULL,
  `sb_cid` varchar(255) default NULL,
  `sb_loc_id` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_mailalert_set`
#

INSERT INTO `sbjbs_mailalert_set` (`sb_id`, `sb_uid`, `sb_cid`, `sb_loc_id`) VALUES (1, 10, '5,6,14', '1,8,9'),
(8, 12, '39', '4'),
(4, 10, '8', '9');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_mails`
#

DROP TABLE IF EXISTS `sbjbs_mails`;
CREATE TABLE `sbjbs_mails` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_mailid` bigint(20) NOT NULL default '0',
  `sb_fromid` varchar(255) NOT NULL default '',
  `sb_subject` varchar(255) NOT NULL default '',
  `sb_mail` longtext NOT NULL,
  `sb_status` varchar(255) NOT NULL default 'no',
  `sb_html_format` varchar(255) NOT NULL default 'no',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_mails`
#

INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (3, 3, 'sbautomail@sbjobseekers.com', 'Update Company profile is waiting for approval', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>A company profile has been updated and is awaiting approval. company Id: %company_id% <BR>company name:%company_name% <BR>profile </FONT><A href="%company_profile_url%"><FONT face="Arial, Helvetica, sans-serif" size=2>url:%company_profile_url%</FONT></A><FONT face="Arial, Helvetica, sans-serif" size=2> <BR></FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>sbAutomail</FONT> </P>', 'yes', 'no'),
(4, 4, 'password@sbjobseekers.com', 'Your password', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %title% %fname%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Here is your login information: <BR>Username: %username% <BR>Password: %password% <BR>Email: %email%</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;Login now at %login_url% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Thanks for being part of our website. </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards,<BR>Admin </FONT></P>', 'yes', 'yes'),
(1, 1, 'welcome@sbjobseekers.com', 'Welcome to sbjobseekers.com', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %title% %fname% %lname%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Welcome to sbjobseekers.com. Your registration information is as follows: <BR>First: %fname% <BR>Last: %lname% <BR>Username: %username% <BR>Password: %password% <BR>Email: %email% <BR>Login: %login_url%</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Thanks for being part of our website.</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;Regards, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Admin </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Login url is %login_url%</FONT> </P>', 'yes', 'no'),
(5, 5, 'sbautomail@sbjobseekers.com', 'New Job has been posted & awaiting your approval', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>A new job has been posted and is awaiting approval. <BR>Job id:%job_id% <BR>Job title:%job_title%<BR> job </FONT><A href="%job_url%"><FONT face="Arial, Helvetica, sans-serif" size=2>url:%job_url%</FONT></A><FONT face="Arial, Helvetica, sans-serif" size=2> <BR>company Id: %company_id% <BR></FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>sbAutomail</FONT> </P>', 'yes', 'no'),
(7, 7, 'admin@sbjob_seekers.com', 'Comments posted to Admin', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %visitor_name%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Your comments have been posted to the Admin at sbjobseekers.com. Details of comments are <BR>visitor: %visitor_name% <BR>message date: %message_date% <BR>message title: %message_title% <BR>message text: %message_text% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Admin</FONT> </P>', 'yes', 'yes'),
(6, 6, 'automail@sbjobseekers.com', 'Employer has updated a job', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Dear Admin </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Member %username% has updated %job_title% at sbjobseekers.com </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Automail</FONT> </P>', 'yes', 'yes'),
(8, 8, 'automail@sbjobseekers.com', 'User Posted Comments', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi Admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>%visitor_name% has posted some comments at sbjobseekers.com. Details of comments are <BR>visitor: %visitor_name%<BR> message date: %message_date% <BR>message title: %message_title% <BR>message text: %message_text% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Automail </FONT></P>', 'yes', 'yes'),
(11, 11, 'admin@sbjobseekers.com', 'Resume', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Respected Sir ,</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;%title% %fname% %lname% has sent resume for your kind attention. Please click the link to view the same.<BR> Resume URL: %resume_url% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>Admin</FONT> </P>', 'yes', 'yes'),
(10, 10, 'confirmation@sbjobseekers.com', 'Your confirmation link to sbjobseekers.com', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Welcome to <A href="www.domain.com">sbjobseekers.com</A>. <BR>Your confirmation link is given below :<BR>Link: %signup_url% <BR>Email: %email% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Thanks for being part of our website.</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Admin </FONT></P>', 'yes', 'no'),
(2, 2, 'sbautomail@sbjobseekers.com', 'Company profile is waiting for approval', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>A new company profile has been posted and is awaiting approval. company Id: %company_id% <BR>company name:%company_name% <BR>profile </FONT><A href=" %company_profile_url%"><FONT face="Arial, Helvetica, sans-serif" size=2>url: %company_profile_url%</FONT></A><FONT face="Arial, Helvetica, sans-serif" size=2> </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>sbAutomail</FONT> </P>', 'yes', 'no'),
(9, 9, 'refer@sbjobseekers.com', 'Your friend has reffered you', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %friend_name%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>While surfing at sbjobseekers.com <VISITOR_NAME>has reffered following link to you. Just click the link below to access this. <BR>Job Title: %job_title%<BR>Job Id: %job_id%<BR>Check this link %job_url%<BR>You can have an account of your\'s at %signup_url%. </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Admin</FONT> </P>', 'yes', 'yes'),
(12, 12, 'sbautomail@sbjobseekers.com', 'Member requested Premium membership', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Dear Admin,</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;%title% %fname% %lname% has requested for premium membership. username: %username% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>Admin</FONT> </P>', 'yes', 'yes'),
(13, 13, 'sbautomail@sbjobseekers.com', 'Mail alerts', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Dear %title% %fname% %lname% , </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>There are %jobcnt% job(s) posted in categories / locations you are interested in. These are<BR> %jobstr% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>Admin</FONT> </P>', 'yes', 'no');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_newsletter`
#

DROP TABLE IF EXISTS `sbjbs_newsletter`;
CREATE TABLE `sbjbs_newsletter` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_email` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_newsletter`
#

INSERT INTO `sbjbs_newsletter` (`sb_id`, `sb_email`) VALUES (27, 'vin@qq.com'),
(2, 'aas!#@sasa.com'),
(3, 'micx@m.com'),
(23, 'vikk@vik.com'),
(14, 'lex@l.com'),
(18, 'test@t.com'),
(25, '\'@\'.com'),
(29, 'new@n.com'),
(30, 'new2@n.com'),
(31, 'new4@n.com'),
(32, 'e_admtes@e.com'),
(33, 'e_admtest@e.com'),
(34, 'mine@m.com');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_online`
#

DROP TABLE IF EXISTS `sbjbs_online`;
CREATE TABLE `sbjbs_online` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_ip` varchar(255) NOT NULL default '',
  `sb_ontime` timestamp(14) NOT NULL,
  `sb_uid` bigint(20) default '0',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_online`
#

INSERT INTO `sbjbs_online` (`sb_id`, `sb_ip`, `sb_ontime`, `sb_uid`) VALUES (565, '127.0.0.1', 20040827175215, -1);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_plans`
#

DROP TABLE IF EXISTS `sbjbs_plans`;
CREATE TABLE `sbjbs_plans` (
  `id` bigint(20) NOT NULL auto_increment,
  `credits` bigint(20) NOT NULL default '0',
  `price` bigint(20) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_plans`
#

INSERT INTO `sbjbs_plans` (`id`, `credits`, `price`) VALUES (10, 4, 12),
(7, 20, 20),
(6, 10, 15),
(9, 20000, 65);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_policies`
#

DROP TABLE IF EXISTS `sbjbs_policies`;
CREATE TABLE `sbjbs_policies` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_legal` longtext,
  `sb_privacy` longtext,
  `sb_terms` longtext,
  `sb_welcome_msg` longtext,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_policies`
#

INSERT INTO `sbjbs_policies` (`sb_id`, `sb_legal`, `sb_privacy`, `sb_terms`, `sb_welcome_msg`) VALUES (1, 'Legal Polic\'ies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here ', 'Privace Pol\'icies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here ', 'Terms of u\'se Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here <br><br><b>Terms</b><br>Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here ', '<p><font size="2" face="Arial, Helvetica, sans-serif"><strong><font color="#3300FF">Welcome \r\n  to Softbiz Jobs and Recruitment Script</font><br>\r\n</font></p>\r\n');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_premium_gallery`
#

DROP TABLE IF EXISTS `sbjbs_premium_gallery`;
CREATE TABLE `sbjbs_premium_gallery` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_emp_id` bigint(20) default NULL,
  `sb_img_url` varchar(255) default NULL,
  `tempdate` timestamp(14) NOT NULL,
  `sb_posted_on` timestamp(14) NOT NULL,
  `sb_approved` varchar(255) default 'no',
  `sb_profile_id` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_premium_gallery`
#

INSERT INTO `sbjbs_premium_gallery` (`sb_id`, `sb_emp_id`, `sb_img_url`, `tempdate`, `sb_posted_on`, `sb_approved`, `sb_profile_id`) VALUES (27, 5, '13193928.gif', 20040716121936, 20040706190204, 'yes', 3),
(28, 6, '9110838.gif', 20040716113451, 20040716113451, 'yes', 0),
(25, 9, '93721823.gif', 20040716113843, 20040625184027, 'yes', 0),
(22, 4, '51905020.gif', 20040716123216, 20040625163923, 'yes', 1);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_profile_cats`
#

DROP TABLE IF EXISTS `sbjbs_profile_cats`;
CREATE TABLE `sbjbs_profile_cats` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_cid` bigint(20) default NULL,
  `sb_company_id` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_profile_cats`
#

INSERT INTO `sbjbs_profile_cats` (`sb_id`, `sb_cid`, `sb_company_id`) VALUES (70, 5, 2),
(78, 41, 6),
(77, 29, 6),
(69, 17, 2),
(76, 4, 5),
(75, 1, 5),
(73, 30, 3),
(72, 28, 3),
(74, 5, 4),
(68, 15, 1),
(67, 7, 1);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_references`
#

DROP TABLE IF EXISTS `sbjbs_references`;
CREATE TABLE `sbjbs_references` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_resume_id` bigint(20) NOT NULL default '0',
  `sb_name` varchar(225) default NULL,
  `sb_phone` varchar(255) default NULL,
  `sb_email` varchar(255) default NULL,
  `sb_company` varchar(255) default NULL,
  `sb_designation` varchar(255) default NULL,
  `sb_relation` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_references`
#

INSERT INTO `sbjbs_references` (`sb_id`, `sb_resume_id`, `sb_name`, `sb_phone`, `sb_email`, `sb_company`, `sb_designation`, `sb_relation`) VALUES (46, 49, 'Minnie', '123-456789-123', '', 'SB Solutions', 'HR Manager', 'professional'),
(47, 49, 'Mickey', '123-34536-789', 'mickey@mickey.com', 'SB Solutions', 'Sr. Programmer', 'professional'),
(48, 50, 'Minnie', '123-456789-123', '', 'SB Solutions', 'HR Manager', 'professional'),
(49, 50, 'Mickey', '123-34536-789', 'mickey@mickey.com', 'SB Solutions', 'Sr. Programmer', 'professional'),
(37, 39, 'sa\'', 'as\'', '', '', '', 'professional'),
(38, 39, 'assa', 'asas', '', '', '', 'professional'),
(39, 39, 'aas', 'sa', '', '', '', 'professional'),
(43, 45, 'Minnie', '123-456789-123', '', 'SB Solutions', 'HR Manager', 'professional'),
(44, 45, 'Mickey', '123-34536-789', 'mickey@mickey.com', 'SB Solutions', 'Sr. Programmer', 'professional');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_resume_cats`
#

DROP TABLE IF EXISTS `sbjbs_resume_cats`;
CREATE TABLE `sbjbs_resume_cats` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_cid` bigint(20) default NULL,
  `sb_resume_id` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_resume_cats`
#

INSERT INTO `sbjbs_resume_cats` (`sb_id`, `sb_cid`, `sb_resume_id`) VALUES (99, 5, 50),
(32, 14, 15),
(33, 15, 15),
(34, 16, 15),
(35, 17, 19),
(36, 18, 19),
(37, 14, 25),
(38, 18, 36),
(39, 3, 37),
(40, 4, 37),
(41, 8, 37),
(82, 31, 39),
(83, 41, 39),
(84, 39, 39),
(97, 5, 45),
(98, 5, 49),
(91, 34, 43),
(90, 39, 43);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_resume_language`
#

DROP TABLE IF EXISTS `sbjbs_resume_language`;
CREATE TABLE `sbjbs_resume_language` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_language_id` bigint(20) NOT NULL default '0',
  `sb_resume_id` bigint(20) NOT NULL default '0',
  `sb_proficiency` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_resume_language`
#

INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (90, 7, 50, 'Fluent - Full Knowledge'),
(89, 7, 49, 'Fluent - Full Knowledge'),
(88, 2, 49, 'Fluent - Full Knowledge'),
(87, 2, 45, 'Fluent - Full Knowledge'),
(86, 7, 45, 'Fluent - Full Knowledge'),
(82, 7, 39, 'Basic - Familiar'),
(79, 4, 37, 'Conversational - Limited'),
(77, 3, 37, 'Fluent - Wide Knowledge'),
(78, 2, 37, 'Conversational - Advanced'),
(17, 3, 15, 'Fluent - Wide Knowledge'),
(18, 2, 15, 'Conversational - Advanced'),
(19, 4, 15, 'Conversational - Limited'),
(20, 4, 15, 'Conversational - Limited'),
(21, 3, 19, 'Fluent - Wide Knowledge'),
(22, 2, 19, 'Conversational - Advanced'),
(23, 4, 19, 'Conversational - Limited'),
(24, 4, 19, 'Conversational - Limited'),
(81, 7, 39, 'Conversational - Advanced'),
(80, 4, 37, 'Conversational - Limited'),
(76, 4, 36, 'Conversational - Limited'),
(75, 4, 36, 'Conversational - Limited'),
(74, 2, 36, 'Conversational - Advanced'),
(73, 3, 36, 'Fluent - Wide Knowledge'),
(45, 4, 25, 'Conversational - Limited'),
(46, 3, 25, 'Fluent - Wide Knowledge'),
(47, 4, 25, 'Conversational - Limited'),
(48, 2, 25, 'Conversational - Advanced'),
(91, 2, 50, 'Fluent - Full Knowledge');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_resume_locs`
#

DROP TABLE IF EXISTS `sbjbs_resume_locs`;
CREATE TABLE `sbjbs_resume_locs` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_loc_id` bigint(20) default NULL,
  `sb_resume_id` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_resume_locs`
#

INSERT INTO `sbjbs_resume_locs` (`sb_id`, `sb_loc_id`, `sb_resume_id`) VALUES (85, 1, 50),
(84, 8, 50),
(83, 12, 50),
(81, 12, 49),
(16, 5, 25),
(15, 17, 19),
(14, 1, 15),
(17, 4, 36),
(18, 5, 37),
(19, 23, 37),
(82, 8, 49),
(61, 9, 39),
(62, 23, 39),
(79, 1, 45),
(68, 1, 43),
(67, 8, 43),
(78, 12, 45),
(80, 1, 49),
(77, 8, 45);
# --------------------------------------------------------

#
# Table structure for table `sbjbs_resume_skills`
#

DROP TABLE IF EXISTS `sbjbs_resume_skills`;
CREATE TABLE `sbjbs_resume_skills` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_skill_id` bigint(20) NOT NULL default '0',
  `sb_resume_id` bigint(20) NOT NULL default '0',
  `sb_level` varchar(255) default NULL,
  `sb_last_month` int(11) default NULL,
  `sb_last_year` int(11) default NULL,
  `sb_experience` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_resume_skills`
#

INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (38, 5, 49, 'Expert', 7, 2003, '1 to 2 Years'),
(37, 2, 49, 'Expert', 13, 2004, '1 to 2 Years'),
(35, 2, 45, 'Expert', 13, 2004, '1 to 2 Years'),
(36, 5, 45, 'Expert', 7, 2003, '1 to 2 Years'),
(25, 2, 15, 'Beginners', 6, 2004, 'Less than 1 Year'),
(26, 3, 19, 'Beginners', 6, 2004, 'Less than 1 Year'),
(27, 3, 25, 'Beginners', 6, 2004, 'Less than 1 Year'),
(28, 3, 36, 'Beginners', 6, 2004, 'Less than 1 Year'),
(29, 3, 37, 'Beginners', 6, 2004, 'Less than 1 Year'),
(30, 2, 39, 'Advance', 6, 2004, 'Less than 1 Year'),
(31, 3, 39, 'Advance', 1, 2004, 'Less than 1 Year'),
(39, 5, 50, 'Expert', 7, 2003, '1 to 2 Years'),
(40, 2, 50, 'Expert', 13, 2004, '1 to 2 Years');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_resumes`
#

DROP TABLE IF EXISTS `sbjbs_resumes`;
CREATE TABLE `sbjbs_resumes` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_seeker_id` bigint(20) NOT NULL default '0',
  `sb_title` varchar(255) default NULL,
  `sb_objective` longtext,
  `sb_additional_info` longtext,
  `sb_salary` bigint(20) NOT NULL default '0',
  `sb_career_level` varchar(255) default NULL,
  `sb_relevent_experience` smallint(6) NOT NULL default '0',
  `sb_availability_time` varchar(255) default NULL,
  `sb_target_job` varchar(255) default NULL,
  `sb_alt_job` varchar(255) default NULL,
  `sb_job_type` int(11) default NULL,
  `sb_job_status` varchar(255) default NULL,
  `sb_target_comp_size` varchar(255) default NULL,
  `sb_target_cats1` varchar(255) default NULL,
  `sb_target_locations1` varchar(255) default NULL,
  `sb_relocate` varchar(255) default NULL,
  `sb_will_to_travel` varchar(255) default NULL,
  `sbtemp` timestamp(14) NOT NULL,
  `sb_posted_on` timestamp(14) NOT NULL,
  `sb_approved` varchar(255) default NULL,
  `sb_firstname` varchar(255) default NULL,
  `sb_lastname` varchar(255) default NULL,
  `sb_addr1` varchar(255) default NULL,
  `sb_city` varchar(255) default NULL,
  `sb_state` varchar(255) default NULL,
  `sb_zip` varchar(255) default NULL,
  `sb_country` bigint(20) NOT NULL default '-1',
  `sb_telephone` varchar(255) default NULL,
  `sb_mobile` varchar(255) default NULL,
  `sb_email` varchar(255) default NULL,
  `sb_hide_info` varchar(255) default 'no',
  `sb_salary_type` varchar(255) default NULL,
  `sb_salary_currency` bigint(20) default NULL,
  `sb_search_enable` varchar(50) default NULL,
  `sb_img_url` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_resumes`
#

INSERT INTO `sbjbs_resumes` (`sb_id`, `sb_seeker_id`, `sb_title`, `sb_objective`, `sb_additional_info`, `sb_salary`, `sb_career_level`, `sb_relevent_experience`, `sb_availability_time`, `sb_target_job`, `sb_alt_job`, `sb_job_type`, `sb_job_status`, `sb_target_comp_size`, `sb_target_cats1`, `sb_target_locations1`, `sb_relocate`, `sb_will_to_travel`, `sbtemp`, `sb_posted_on`, `sb_approved`, `sb_firstname`, `sb_lastname`, `sb_addr1`, `sb_city`, `sb_state`, `sb_zip`, `sb_country`, `sb_telephone`, `sb_mobile`, `sb_email`, `sb_hide_info`, `sb_salary_type`, `sb_salary_currency`, `sb_search_enable`, `sb_img_url`) VALUES (49, 10, 'Web Developer and Technologist', 'I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. ', 'Additional Information here like ..\r\n\r\nHobbies : Reading, Programming, Travelling ...\r\n\r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\n', 10000, '4', 1, '1', 'Sr Programmer', 'Programmer, Developer', 7, '3', '1', NULL, NULL, NULL, '2', 20040707092623, 20040707090338, 'yes', 'Evita', 'Singla', '#141, ST MKS', 'LDH', 'New', '129gg565', 210, '11-123-12345678', '9812378789', 'abc@abc.com', 'yes', '3', 2, 'no', '73619182.gif'),
(45, 10, 'Results Oriented Programmer', 'I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. ', 'Additional Information here like ..\r\n\r\nHobbies : Reading, Programming, Travelling ...\r\n\r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\n', 10000, '4', 1, '1', 'Sr Programmer', 'Programmer, Developer', 7, '3', '1', NULL, NULL, '1', '2', 20040707094938, 20040707085512, 'updated', 'Evita', 'Singla', '#141, ST MKS', 'LDH', 'New', '129gg565', 210, '11-1122-122222333', '211233332', 'abc@abc.com', 'yes', '3', 2, 'no', '92416305.jpg'),
(50, 10, 'Expert Programmer', 'I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. I want myself to be .. ', 'Additional Information here like ..\r\n\r\nHobbies : Reading, Programming, Travelling ...\r\n\r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\nGot thisaward for doing thatwork \r\n', 10000, '4', 1, '1', 'Sr Programmer', 'Programmer, Developer', 7, '3', '1', NULL, NULL, NULL, '2', 20040707092611, 20040707091919, 'yes', 'Evita', 'Singla', '#141, ST MKS', 'LDH', 'New', '129gg565', 210, '11-123-12345678', '9812378789', 'abc@abc.com', 'yes', '3', 2, 'no', '73619182.gif');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_search_results`
#

DROP TABLE IF EXISTS `sbjbs_search_results`;
CREATE TABLE `sbjbs_search_results` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_uid` bigint(20) default NULL,
  `sb_title` varchar(255) default NULL,
  `sb_keyword` varchar(255) default NULL,
  `sb_search_method` bigint(20) default NULL,
  `sb_cid_list` varchar(255) default NULL,
  `sb_loc_id` varchar(255) default NULL,
  `sb_work_exp` varchar(255) default NULL,
  `sb_view` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_search_results`
#

INSERT INTO `sbjbs_search_results` (`sb_id`, `sb_uid`, `sb_title`, `sb_keyword`, `sb_search_method`, `sb_cid_list`, `sb_loc_id`, `sb_work_exp`, `sb_view`) VALUES (13, 12, 'all_search_26_jun', '', 1, '', '', '0', 'brief'),
(14, 12, 'desc_search', '', 1, '', '', '0', 'desc'),
(18, 10, 'all2', '', 1, '', '', '', 'brief');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_seekers`
#

DROP TABLE IF EXISTS `sbjbs_seekers`;
CREATE TABLE `sbjbs_seekers` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_username` varchar(255) default NULL,
  `sb_password` varchar(255) default NULL,
  `sb_title` varchar(255) default NULL,
  `sb_firstname` varchar(255) default NULL,
  `sb_lastname` varchar(255) default NULL,
  `sbtemp` timestamp(14) NOT NULL,
  `sb_dob` timestamp(14) NOT NULL,
  `sb_addr1` varchar(255) default NULL,
  `sb_city` varchar(255) default NULL,
  `sb_state` varchar(255) default NULL,
  `sb_zip` varchar(255) default NULL,
  `sb_country` bigint(20) NOT NULL default '-1',
  `sb_telephone` varchar(255) default NULL,
  `sb_mobile` varchar(255) default NULL,
  `sb_email_addr` varchar(255) default NULL,
  `sb_last_login` timestamp(14) NOT NULL,
  `sb_signup_on` timestamp(14) NOT NULL,
  `sb_suspended` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_seekers`
#

INSERT INTO `sbjbs_seekers` (`sb_id`, `sb_username`, `sb_password`, `sb_title`, `sb_firstname`, `sb_lastname`, `sbtemp`, `sb_dob`, `sb_addr1`, `sb_city`, `sb_state`, `sb_zip`, `sb_country`, `sb_telephone`, `sb_mobile`, `sb_email_addr`, `sb_last_login`, `sb_signup_on`, `sb_suspended`) VALUES (9, 'hey', 'a', 'Mr.', 'hey1', 'hey', 20040707102857, 00000000000000, 'aa', 'aa', 'Alabama', '222', 2, '11-22-33', '1111', 'hey@h.com', 20040707102857, 20040609204614, 'no'),
(3, 'mine', 'a', 'Ms.', 'mine', 'kaur', 20040707102522, 19800126000000, 'lm', 'bt', 'Alabama', '148106', 89, '1-22-333', '122333', 'mine@m.com', 20040707102522, 20040609182252, 'no'),
(4, 'rex', 'a', 'Mr.', 'a', 'a', 20040626183259, 19990401000000, 'a', 'a', 'a', 'a', 1, '--', '', 'rex@r.com', 00000000000000, 20040619182802, 'no'),
(15, 'new2', 'a', 'Mr.', 'new2 f', 'new2 l', 20040705175544, 00000000000000, 'st new2', 'ci new 2', 'Arizona', '911', 210, '99-11-11', 'mo', 'new2@n.com', 00000000000000, 20040705175544, 'no'),
(6, 'grant', 'a', 'Dr.', 'allen', 'grant', 20040609185552, 00000000000000, 'st1', 'city1', 'non', '1234', 205, '--', '', 'grant@g.com', 00000000000000, 20040609185552, 'no'),
(7, 'lex', 'a', 'Ms.', 'lexia', 'tod', 20040706121305, 00000000000000, 'lex street', 'lex city', 'lex state', '123345', 96, '11-22-333333', '111111111111111111', 'lex@l.com', 20040706121305, 20040609190144, 'no'),
(8, 'tina', 'a', 'Mrs.', 'tina', 'ver', 20040609190351, 00000000000000, 'tina street', 'tina city', 'tina state', '11111111', 114, '--', '22222222222', 'tina@t.com', 00000000000000, 20040609190351, 'no'),
(10, 'demo', 'demo', 'Ms.', 'Evita', 'Singla', 20040826155157, 19780629235959, 'strt1', 'Delhi', 'Delhi', '123113', 89, '212-12-12', 'dfdf', 'vin@qq.com', 20040826155157, 20040610145337, 'no'),
(12, 'vin', '\'\'', 'Mr.', '\'', '\'', 20040706142125, 19900101235959, '\'', '\'', '\'', '\'', 27, '\'-\'-\'', '\'', '\'@\'.com', 20040626161250, 20040626085421, 'no'),
(14, 'new_mem', 'a', 'Mr.', 'nf', 'nl', 20040705174056, 19900101235959, 'st new', 'ci new', 'Alaska', '111', 3, '99-99-99', '99', 'new@n.com', 00000000000000, 20040705174056, 'no'),
(16, 'new3', 'a', 'Mr.', 'a', 'a', 20040705180928, 20000610235959, 'jhg', 'jh', 'Hawaii', 'jh', 84, 'jh-jh-jh', 'jh', 'new3@ghg.com', 20040705180928, 20040705180856, 'no'),
(17, 'new4', 'a', 'Mrs.', 'new4 fname\'1', 'new lname\'1', 20040705190055, 19820328000000, 'new4 st\'1', 'new4 ci\'1', 'Alaska', 'new4 zip\'1', 3, '12-22-33', '42', 'mine1@m.com', 00000000000000, 20040705181237, 'no');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_signups`
#

DROP TABLE IF EXISTS `sbjbs_signups`;
CREATE TABLE `sbjbs_signups` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_rnum` varchar(255) default '',
  `sb_email` varchar(255) default '',
  `sb_onstamp` timestamp(14) NOT NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_signups`
#

# --------------------------------------------------------

#
# Table structure for table `sbjbs_skills`
#

DROP TABLE IF EXISTS `sbjbs_skills`;
CREATE TABLE `sbjbs_skills` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_name` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_skills`
#

INSERT INTO `sbjbs_skills` (`sb_id`, `sb_name`) VALUES (5, 'Programming C/C++'),
(2, 'Programming ASP/PHP'),
(3, 'Programming .NET'),
(6, 'Inter Personnel');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_styles`
#

DROP TABLE IF EXISTS `sbjbs_styles`;
CREATE TABLE `sbjbs_styles` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_title` varchar(255) default NULL,
  `sb_page_bg` varchar(255) default NULL,
  `sb_table_bg` varchar(255) default NULL,
  `sb_inner_table_bg` varchar(255) default NULL,
  `sb_seperator` varchar(255) default NULL,
  `sb_title_bg` varchar(255) default NULL,
  `sb_title_font_color` varchar(255) default NULL,
  `sb_title_font` varchar(255) default NULL,
  `sb_title_font_size` varchar(255) default NULL,
  `sb_normal_font_color` varchar(255) default NULL,
  `sb_normal_font` varchar(255) default NULL,
  `sb_normal_font_size` varchar(255) default NULL,
  `sb_normal_table_bg` varchar(255) default NULL,
  `sb_link_font` varchar(255) default NULL,
  `sb_link_font_color` varchar(255) default NULL,
  `sb_link_font_size` varchar(255) default NULL,
  `sb_side_title_bg` varchar(255) default NULL,
  `sb_side_title_font` varchar(255) default NULL,
  `sb_side_title_font_color` varchar(255) default NULL,
  `sb_side_title_font_size` varchar(255) default NULL,
  `sb_sub_title_bg` varchar(255) default NULL,
  `sb_highlighted` varchar(255) default 'FFFFCC',
  `sb_highlighted1` varchar(255) default 'FFFFDD',
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_styles`
#

INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (4, 'Red', 'FFFFFF', 'FFFFFF', 'F5F5F5', 'FFA8A8', 'FFD5D5', '990000', 'Arial', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '990000', '12', 'C33100', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD'),
(13, 'Australia (Gold, Green)', '00BB00', 'FFFFFF', 'FFFFBB', 'FFCC00', '00BB00', '000000', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '006600', '12', 'FFCC00', NULL, '000000', NULL, 'FFFF99', 'FFCCCC', 'FFDDDD'),
(14, 'Green', 'FFFFFF', 'F4FFFA', 'F0FDE8', '0E6900', '0E6900', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'F0FDE8', 'Arial, Helvetica, sans-serif', '0E6900', '12', '073E00', NULL, 'FFFFFF', NULL, 'E7FCDA', 'FFFFCC', 'FFFFDD'),
(15, 'Gray - Black', 'FFFFFF', 'FAFAFA', 'F5F5F5', 'cccccc', '363636', 'ffffff', 'Arial, Helvetica, sans-serif', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'FAFAFA', 'Arial, Helvetica, sans-serif', '990000', '12', '333333', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD'),
(16, 'Blue', 'ECF5FF', 'FFFFFF', 'F5F5F5', '0078CC', '3C9DFF', 'FFFFFF', 'Courier New, Courier, mono', '18', '333333', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '0023CD', '12', '0068C3', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD'),
(17, 'Blue Red', 'FFFFFF', 'FFFFFF', 'F5F5F5', 'CCCCCC', 'CF411D', 'FFFFFF', NULL, NULL, '333333', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '00509F', '12', '004080', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD'),
(18, 'Yellow (default)', 'FEFBEB', 'FEFBEB', 'FDF0D9', 'CC9933', 'E0AE2C', 'FFFFFF', NULL, NULL, '6B4418', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '004080', '12', '9B0000', NULL, 'FFFFFF', NULL, 'FCE7BE', 'FFFFCC', 'FFFFDD'),
(19, 'Canada,Dames,Swiss(Red,White)', 'FFF4F4', 'FFFFFF', 'FFF4F4', 'CE1D27', 'CE1D27', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'FFF4F4', 'Arial, Helvetica, sans-serif', 'CE1D27', '12', 'CE1D27', NULL, 'FFFFFF', NULL, 'FCEBEC', 'FFFFCC', 'FFFFDD'),
(20, 'Germany (Gold, Red, Black)', 'EBAE18', 'FFFFFF', 'F5F5F5', 'CC2225', 'CC2225', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', 'CC2225', '12', '000000', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD'),
(21, 'US (Blue,Red)', '1C237D', 'FFFFFF', 'E7E8FA', 'CE1D27', 'CE1D27', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'E7E8FA', 'Arial, Helvetica, sans-serif', 'CE1D27', '12', 'CE1D27', NULL, 'FFFFFF', NULL, 'CACCF4', 'FFFFCC', 'FFFFDD'),
(22, 'UK (Red,Blue)', 'FE0000', 'FFFFFF', 'FFF0F0', '0B4199', '0000D9', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'FFF0F0', 'Arial, Helvetica, sans-serif', '0B4199', '12', '0000D9', NULL, 'FFFFFF', NULL, 'FFDFDF', 'FFFFCC', 'FFFFDD'),
(23, 'Netherlands (Orange)', 'FFFFFF', 'FFFFFF', 'FFF3E8', 'FF8306', 'FF6D0D', 'FFFFFF', 'Arial', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'FFF3E8', 'Arial, Helvetica, sans-serif', 'F0400D', '12', 'FF6D0D', NULL, 'FFFFFF', NULL, 'FFE7CE', 'FFFFCC', 'FFFFDD'),
(24, 'Sweden (Yellow,Blue)', '00009B', 'FEFCED', 'FDF9D9', 'EBCE10', 'EBCE10', '000000', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'FDF9D9', 'Arial, Helvetica, sans-serif', '00009B', '12', 'EBCE10', NULL, '000000', NULL, 'FCF7C9', 'FFFFCC', 'FFFFDD'),
(25, 'New Zealand (Black,Gray)', 'FFFFFF', 'F5F5F5', 'E5E5E5', 'BBBBBB', '000000', 'FAFAFA', 'Arial, Helvetica, sans-serif', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'E5E5E5', 'Arial, Helvetica, sans-serif', '990000', '12', '000000', NULL, 'FAFAFA', NULL, 'DDDDDD', 'FFFFCC', 'FFFFDD'),
(26, 'France (Blue)', 'F2F7FF', 'FFFFFF', 'F2F7FF', '0078CC', '0236AE', 'FFFFFF', 'Courier New, Courier, mono', '18', '333333', 'Arial, Helvetica, sans-serif', '12', 'F2F7FF', 'Arial, Helvetica, sans-serif', '0023CD', '12', '0236AE', NULL, 'FFFFFF', NULL, 'DFE9FF', 'FFFFCC', 'FFFFDD');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_timeformats`
#

DROP TABLE IF EXISTS `sbjbs_timeformats`;
CREATE TABLE `sbjbs_timeformats` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_format` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_timeformats`
#

INSERT INTO `sbjbs_timeformats` (`sb_id`, `sb_format`) VALUES (1, '06:20 pm'),
(2, '06:20 PM'),
(3, '18:20');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_transactions`
#

DROP TABLE IF EXISTS `sbjbs_transactions`;
CREATE TABLE `sbjbs_transactions` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_uid` bigint(20) default NULL,
  `sb_amount` decimal(10,2) default NULL,
  `sbtemp` timestamp(14) NOT NULL,
  `sb_date_submitted` timestamp(14) NOT NULL,
  `sb_description` longtext,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_transactions`
#

INSERT INTO `sbjbs_transactions` (`sb_id`, `sb_uid`, `sb_amount`, `sbtemp`, `sb_date_submitted`, `sb_description`) VALUES (1, 4, '65000.00', 20040622165644, 20040614205345, 'by adm'),
(2, 4, '-500.00', 20040614205355, 20040614205355, 'Posted your job \'a12\''),
(3, 4, '-200.00', 20040614205355, 20040614205355, 'Posted your job \'a12\' in 1 additional categoies)'),
(4, 4, '-400.00', 20040614205355, 20040614205355, 'Posted your job \'a12\' in 2 additional locations'),
(5, 4, '-10.00', 20040614205355, 20040614205355, 'Made your job \'a12\' to appear as Front Featured'),
(6, 4, '-20.00', 20040614205355, 20040614205355, 'Made your job \'a12\' to appear as Featured'),
(7, 4, '-40.00', 20040614205355, 20040614205355, 'Made your job \'a12\' to appear as Bold'),
(8, 4, '-500.00', 20040615112223, 20040615112223, 'Posted your job \'aa\''),
(9, 4, '-20.00', 20040615112223, 20040615112223, 'Made your job \'aa\' to appear as Featured'),
(10, 4, '500.00', 20040615153752, 20040615124143, 'Money added through paypal'),
(24, 4, '-30.00', 20040615173008, 20040615173008, 'Made your job \'ghgh\' to appear as Highlighted'),
(25, 4, '-0.20', 20040615175932, 20040615175932, 'Made your job \'a\' to appear as Highlighted'),
(26, 4, '-0.10', 20040615180017, 20040615180017, 'Made your job \'e_mine job1 title\' to appear as Featured'),
(23, 4, '-0.10', 20040615172307, 20040615172307, 'Made your job \'aa\' to appear as Featured'),
(16, 4, '-40.00', 20040615154013, 20040615154013, 'Made your job \'aa\' to appear as Bold'),
(22, 4, '-10.00', 20040615170811, 20040615170811, 'Made your job \'ghgh\' to appear as Front Featured'),
(19, 4, '-500.00', 20040615164130, 20040615164130, 'Posted your job \'hhh\''),
(20, 4, '-10.00', 20040615164130, 20040615164130, 'Made your job \'hhh\' to appear as Front Featured'),
(21, 4, '-500.00', 20040615164343, 20040615164343, 'Posted your job \'ghgh\''),
(27, 4, '-500.00', 20040621103646, 20040621103646, 'Posted your job \'test job br newline\''),
(28, 4, '-500.00', 20040622142948, 20040622142948, 'Posted your job \'aaaaaaa\''),
(29, 4, '-0.10', 20040622142948, 20040622142948, 'Made your job \'aaaaaaa\' to appear as Featured'),
(30, 4, '-500.00', 20040622163355, 20040622163355, 'Posted your job \'test1\''),
(31, 4, '-200.00', 20040622163355, 20040622163355, 'Posted your job \'test1\' in 1 additional categoies'),
(32, 4, '-200.00', 20040622163355, 20040622163355, 'Posted your job \'test1\' in 1 additional locations'),
(33, 4, '-500.00', 20040622164332, 20040622164332, 'Posted your job \'test2\''),
(34, 4, '-200.00', 20040622164332, 20040622164332, 'Posted your job \'test2\' in 1 additional categoies'),
(35, 4, '-200.00', 20040622164332, 20040622164332, 'Posted your job \'test2\' in 1 additional locations'),
(36, 4, '-500.00', 20040622164645, 20040622164645, 'Posted your job \'test3\''),
(37, 4, '-200.00', 20040622164645, 20040622164645, 'Posted your job \'test3\' in 1 additional categoies'),
(38, 4, '-200.00', 20040622164645, 20040622164645, 'Posted your job \'test3\' in 1 additional locations'),
(39, 4, '-500.00', 20040622165849, 20040622165849, 'Posted your job \'test5\''),
(40, 4, '-200.00', 20040622165849, 20040622165849, 'Posted your job \'test5\' in 1 additional categoies'),
(41, 4, '-200.00', 20040622165849, 20040622165849, 'Posted your job \'test5\' in 1 additional locations'),
(42, 1, '700.00', 20040622175923, 20040622170210, 'by adm'),
(62, 1, '900.00', 20040623090604, 20040623090604, 'Money added through paypal'),
(56, 1, '-500.00', 20040622183940, 20040622183940, 'Posted your job \'cat test 2 same\''),
(57, 1, '-200.00', 20040622183940, 20040622183940, 'Posted your job \'cat test 2 same\' in 1 additional locations'),
(58, 1, '700.00', 20040623085018, 20040623085018, 'Money added through paypal'),
(59, 1, '-500.00', 20040623085334, 20040623085334, 'Posted your job \'new jon\''),
(60, 1, '700.00', 20040623085811, 20040623085811, 'Money added through paypal'),
(61, 1, '-500.00', 20040623085901, 20040623085901, 'Posted your job \'new job 1\''),
(63, 1, '-500.00', 20040623090641, 20040623090641, 'Posted your job \'new job 3\''),
(64, 1, '-500.00', 20040623091148, 20040623091148, 'Posted your job \'aaa\''),
(65, 1, '900.00', 20040623091243, 20040623091243, 'Money added through paypal'),
(66, 1, '-500.00', 20040623120415, 20040623120415, 'Posted your job \'test final\''),
(67, 1, '-200.00', 20040623120415, 20040623120415, 'Posted your job \'test final\' in 1 additional categoies'),
(68, 1, '-200.00', 20040623120415, 20040623120415, 'Posted your job \'test final\' in 1 additional locations'),
(69, 1, '800.00', 20040623124107, 20040623124107, 'Money added through paypal'),
(70, 1, '-500.00', 20040623125128, 20040623125128, 'Posted your job \'fffffffffffff\''),
(71, 1, '-200.00', 20040623125128, 20040623125128, 'Posted your job \'fffffffffffff\' in 1 additional categoies'),
(72, 1, '-200.00', 20040623125128, 20040623125128, 'Posted your job \'fffffffffffff\' in 1 additional locations'),
(73, 1, '-200.00', 20040623144111, 20040623144111, 'Updated job \'test final\' posted in 1 additional locations'),
(74, 1, '900.00', 20040623155843, 20040623155843, 'Money added through paypal'),
(75, 4, '-600.00', 20040624095430, 20040624095430, 'Made your membership premium'),
(76, 5, '10.00', 20040624100517, 20040624100517, 'Money added through paypal'),
(77, 4, '-2.00', 20040624120350, 20040624120350, 'Enabled resume search for 4 days'),
(78, 4, '-2.00', 20040624121709, 20040624121709, 'Enabled resume search for 8 days'),
(79, 5, '-10.00', 20040624122005, 20040624122005, 'Made your membership premium'),
(80, 7, '100.00', 20040624122206, 20040624122206, 'Money added through paypal'),
(81, 7, '-10.00', 20040624122241, 20040624122241, 'Made your membership premium'),
(82, 4, '-10.00', 20040624123748, 20040624123748, 'Enabled resume search for 20 days'),
(83, 4, '-10.00', 20040624124224, 20040624124224, 'Enabled resume search for 20 days'),
(84, 4, '0.00', 20040624124414, 20040624124414, 'Updated job \'test5\' posted in 1 additional categoies'),
(85, 4, '-2.00', 20040624124643, 20040624124643, 'Enabled resume search for 4 days'),
(86, 4, '-10.00', 20040624124805, 20040624124805, 'Enabled resume search for 20 days'),
(87, 4, '-500.00', 20040624125028, 20040624125028, 'Posted your job \'this\''),
(88, 4, '-200.00', 20040624125028, 20040624125028, 'Posted your job \'this\' in 1 additional locations'),
(89, 1, '-200.00', 20040624125157, 20040624125157, 'Updated job \'that\' posted in 1 additional categoies'),
(90, 1, '-200.00', 20040624125535, 20040624125535, 'Updated job \'test finale\' posted in 1 additional categoies'),
(91, 1, '-200.00', 20040624130239, 20040624130239, 'Updated job \'test finale\' posted in 1 additional categoies'),
(92, 1, '200.00', 20040624142256, 20040624142256, 'Money added through paypal'),
(93, 4, '-200.00', 20040624170425, 20040624170425, 'Updated job \'test5\' posted in 1 additional categoies'),
(94, 4, '-200.00', 20040624174804, 20040624174804, 'Updated job \'job 22\' posted in 1 additional categoies'),
(95, 4, '-200.00', 20040624174804, 20040624174804, 'Updated job \'job 22\' posted in 1 additional locations'),
(96, 4, '-200.00', 20040624174912, 20040624174912, 'Updated job \'job 22\' posted in 1 additional categoies'),
(97, 4, '-200.00', 20040624174945, 20040624174945, 'Updated job \'job 22\' posted in 1 additional categoies'),
(98, 4, '-500.00', 20040624181632, 20040624181632, 'Posted your job \'newwwwwww\''),
(99, 4, '-200.00', 20040624181632, 20040624181632, 'Posted your job \'newwwwwww\' in 1 additional locations'),
(100, 4, '-20.00', 20040624183653, 20040624183653, 'Updated job \'test51\' posted in 1 additional locations'),
(101, 4, '-20.00', 20040624184440, 20040624184440, 'Updated job \'test51\' posted in 1 additional categoies'),
(103, 4, '-20.00', 20040624185019, 20040624185019, 'Updated job \'test51\' posted in 1 additional locations'),
(104, 5, '35.00', 20040624193430, 20040624193201, 'Money added through paypal'),
(105, 5, '-20.00', 20040624193232, 20040624193232, 'Updated job \'job 19\' posted in 1 additional categoies'),
(106, 5, '7.00', 20040625083938, 20040624200514, 'Money added through paypal'),
(111, 4, '1234.00', 20040625085440, 20040625085440, 'Added by Admin'),
(112, 4, '-100.00', 20040625162809, 20040625162809, 'Made your membership premium'),
(113, 4, '-100.00', 20040625163923, 20040625163923, 'Made your membership premium'),
(114, 4, '-60.00', 20040625180105, 20040625180105, 'Made your job \'aaaaaaa\' to appear as Front Featured'),
(115, 4, '-60.00', 20040625180117, 20040625180117, 'Made your job \'job 22\' to appear as Front Featured'),
(116, 10, '100.00', 20040625183715, 20040625183715, 'Money added through paypal'),
(117, 10, '-100.00', 20040625183819, 20040625183819, 'Made your membership premium'),
(118, 11, '100.00', 20040626140856, 20040626140856, 'Money added through paypal'),
(119, 11, '-50.00', 20040626143408, 20040626143408, 'Posted your job \'vinjob1 \''),
(120, 11, '-10.00', 20040626143408, 20040626143408, 'Made your job \'vinjob1 \' to appear as Highlighted'),
(121, 11, '-5.00', 20040626143408, 20040626143408, 'Made your job \'vinjob1 \' to appear as Bold'),
(122, 11, '-2.00', 20040626150810, 20040626150810, 'Enabled resume search for 4 days'),
(123, 11, '-10.00', 20040626151752, 20040626151752, 'Made your membership premium'),
(124, 11, '50.00', 20040626162926, 20040626162926, 'Money added through paypal'),
(125, 11, '-50.00', 20040626163009, 20040626163009, 'Posted your job \'dd\''),
(126, 4, '10.00', 20040626181907, 20040626061907, 'Added by Admin'),
(127, 4, '-10.00', 20040626181940, 20040626061940, 'Deducted by Admin'),
(132, 4, '-5.00', 20040705114437, 20040705114437, 'Posted your job \'jg\''),
(129, 4, '-5.00', 20040705093210, 20040705093210, 'Made your job \'test51\' to appear as Featured'),
(130, 4, '-3.00', 20040705093216, 20040705093216, 'Made your job \'test51\' to appear as Highlighted'),
(131, 4, '-2.00', 20040705093220, 20040705093220, 'Made your job \'test51\' to appear as Bold'),
(133, 4, '-5.00', 20040705115558, 20040705115558, 'Posted your job \'kjh\''),
(134, 4, '-5.00', 20040705115715, 20040705115715, 'Posted your job \'lkjkl\''),
(135, 4, '-5.00', 20040705115805, 20040705115805, 'Posted your job \'kjhkh\''),
(136, 5, '-12.00', 20040705142815, 20040705142815, 'Enabled resume search for 4 days'),
(137, 5, '-5.00', 20040706101554, 20040706101554, 'Posted your job \'job mul\''),
(138, 5, '4.00', 20040706115605, 20040706115605, 'Money added through paypal'),
(139, 5, '3.00', 20040706115648, 20040706115648, 'Money added through paypal'),
(140, 5, '-12.00', 20040706115655, 20040706115655, 'Enabled resume search for 4 days'),
(142, 4, '-10.00', 20040706183335, 20040706183335, 'Updated job \'Programme Officers\' posted in 1 additional categoies'),
(143, 4, '-20.00', 20040706183335, 20040706183335, 'Updated job \'Programme Officers\' posted in 2 additional locations'),
(144, 5, '100.00', 20040706190107, 20040706190107, 'Money added through paypal'),
(145, 5, '-10.01', 20040706190204, 20040706190204, 'Made your membership premium'),
(146, 5, '-10.00', 20040706190812, 20040706190812, 'Updated job \'Graphics Designer\' posted in 1 additional locations'),
(147, 15, '5.00', 20040707101649, 20040707101649, 'Money added through paypal'),
(148, 15, '-5.00', 20040707102002, 20040707102002, 'Posted your job \'dont_delete job1 title\''),
(149, 15, '50.00', 20040707102116, 20040707102116, 'Money added through paypal'),
(150, 15, '-5.00', 20040707102228, 20040707102228, 'Posted your job \'dont_delete job2 title\''),
(151, 15, '-5.00', 20040707102434, 20040707102434, 'Posted your job \'dont_delete job3 title\''),
(152, 15, '-15.00', 20040707102434, 20040707102434, 'Made your job \'dont_delete job3 title\' to appear as Front Featured'),
(153, 10, '12.00', 20040708123753, 20040708123753, 'Money added through paypal'),
(154, 5, '-12.00', 20040716102142, 20040716102142, 'Enabled resume search for 4 days'),
(155, 6, '100.00', 20040716113417, 20040716113417, 'Money added through paypal'),
(156, 6, '-10.01', 20040716113451, 20040716113451, 'Made your membership premium');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_us_states`
#

DROP TABLE IF EXISTS `sbjbs_us_states`;
CREATE TABLE `sbjbs_us_states` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_state` varchar(255) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_us_states`
#

INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (1, 'Alabama'),
(2, 'Alaska'),
(3, 'Arizona'),
(4, 'Arkansas'),
(5, 'California'),
(6, 'Colorado'),
(7, 'Connecticut'),
(8, 'Delaware'),
(9, 'Florida'),
(10, 'Georgia'),
(11, 'Hawaii'),
(12, 'Idaho'),
(13, 'Illinois'),
(14, 'Indiana'),
(15, 'Iowa'),
(16, 'Kansas'),
(17, 'Kentucky'),
(18, 'Louisiana'),
(19, 'Maine'),
(20, 'Maryland'),
(21, 'Massachusetts'),
(22, 'Michigan'),
(23, 'Minnesota'),
(24, 'Mississippi'),
(25, 'Missouri'),
(26, 'Montana'),
(27, 'Nebraska'),
(28, 'Nevada'),
(29, 'New Hampshire'),
(30, 'New Jersey'),
(31, 'New Mexico'),
(32, 'New York'),
(33, 'North Carolina'),
(34, 'North Dakota'),
(35, 'Ohio'),
(36, 'Oklahoma'),
(37, 'Oregon'),
(38, 'Pennsylvania'),
(39, 'Rhode Island'),
(40, 'South Carolina'),
(41, 'South Dakota'),
(42, 'Tennessee'),
(43, 'Texas'),
(44, 'Utah'),
(45, 'Vermont'),
(46, 'Virginia'),
(47, 'Washington'),
(48, 'Washington DC'),
(49, 'West Virginia'),
(50, 'Wisconsin'),
(51, 'Wyoming');

