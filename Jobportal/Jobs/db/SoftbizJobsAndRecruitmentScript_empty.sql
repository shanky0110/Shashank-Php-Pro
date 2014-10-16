# phpMyAdmin MySQL-Dump
# version 2.3.2
# http://www.phpmyadmin.net/ (download page)
#
# Host: localhost
# Generation Time: Oct 08, 2004 at 01:07 PM
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

INSERT INTO `sbjbs_affiliations` (`sb_id`, `sb_resume_id`, `sb_affiliation`, `sb_start_month`, `sb_start_year`, `sb_end_month`, `sb_end_year`, `sb_company`) VALUES (28, 39, '\'', 1, 2004, 13, 2004, '\'');
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

INSERT INTO `sbjbs_businesstypes` (`sb_id`, `sb_businesstype`) VALUES (2, 'Placement Agency');
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

INSERT INTO `sbjbs_categories` (`sb_id`, `sb_cat_name`, `sb_pid`, `sb_order_index`) VALUES (33, 'Healthcare Services', 0, 33);
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

INSERT INTO `sbjbs_config` (`sb_id`, `sb_admin_email`, `sb_site_name`, `sb_site_root`, `sb_style_list`, `sb_recperpage`, `sb_icon_list`, `sb_date_format`, `sb_time_format`, `sb_mem_approval`, `sb_profile_approval`, `sb_resume_approval`, `sb_job_approval`, `sb_premium_approval`, `sb_letter_approval`, `sb_null_char`, `sb_signup_verification`, `sb_logo`, `sb_site_keywords`, `sbcomp_cat_cnt`, `sb_image_size`, `sb_title_len`, `sb_job_desc_len`, `sb_resume_desc_len`, `sb_cover_letter_len`, `sb_job_cnt`, `sb_resume_cnt`, `sb_company_cnt`, `sb_letter_cnt`, `sb_fee_symbol`, `sb_fee_code`, `sb_premium_fee`, `sb_job_fee`, `sb_job_fee_additional`, `sb_front_featured_fee`, `sb_featured_fee`, `sb_highlight_fee`, `sb_bold_fee`, `sb_premium_cnt`, `sb_featured_cnt`, `last_sent`, `sb_cat_listing`, `sb_paypal_id`) VALUES (1, 'admin@sbjobseekers.com', 'Softbiz Job Hunt Script', 'http://p4two/job_seekers', 4, 5, 2, 9, 2, 'auto', 'auto', 'admin', 'auto', 'auto', 'auto', '- -', 'no', '15014246.gif', 'jobs,resumes,career', 2, 60000, 50, 4000, 3000, 3500, 9, 5, 5, 5, '$', 'USD', '10.01', '5.00', '10.00', '15.00', '10.00', '8.00', '6.00', 2, 5, 20041008, 'alpha', 'softbizscripts@rediffmail.com');
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

INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Afghanistan', 1);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Albania', 2);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Algeria', 3);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Andorra', 4);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Angola', 5);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Anguilla', 6);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Antigua & Barbuda', 7);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Argentina', 8);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Armenia', 9);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Austria', 10);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Azerbaijan', 11);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bahamas', 12);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bahrain', 13);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bangladesh', 14);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Barbados', 15);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Belarus', 16);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Belgium', 17);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Belize', 18);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Belize', 19);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bermuda', 20);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bhutan', 21);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bolivia', 22);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bosnia and Herzegovina', 23);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Botswana', 24);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Brazil', 25);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Brunei', 26);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Bulgaria', 27);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Burkina Faso', 28);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Burundi', 29);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cambodia', 30);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cameroon', 31);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Canada', 32);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cape Verde', 33);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cayman Islands', 34);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Central African Republic', 35);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Chad', 36);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Chile', 37);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('China', 38);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Colombia', 39);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Comoros', 40);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Congo', 41);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Congo (DRC)', 42);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cook Islands', 43);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Costa Rica', 44);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cote d\'Ivoire', 45);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Croatia (Hrvatska)', 46);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cuba', 47);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Cyprus', 48);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Czech Republic', 49);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Denmark', 50);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Djibouti', 51);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Dominica', 52);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Dominican Republic', 53);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('East Timor', 54);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Ecuador', 55);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Egypt', 56);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('El Salvador', 57);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Equatorial Guinea', 58);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Eritrea', 59);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Estonia', 60);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Ethiopia', 61);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Falkland Islands', 62);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Faroe Islands', 63);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Fiji Islands', 64);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Finland', 65);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('France', 66);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('French Guiana', 67);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('French Polynesia', 68);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Gabon', 69);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Gambia', 70);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Georgia', 71);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Germany', 72);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Ghana', 73);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Gibraltar', 74);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Greece', 75);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Greenland', 76);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Grenada', 77);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Guadeloupe', 78);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Guam', 79);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Guatemala', 80);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Guinea', 81);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Guinea-Bissau', 82);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Guyana', 83);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Haiti', 84);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Honduras', 85);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Hong Kong SAR', 86);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Hungary', 87);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Iceland', 88);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('India', 89);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Indonesia', 90);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Iran', 91);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Iraq', 92);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Ireland', 93);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Israel', 94);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Italy', 95);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Jamaica', 96);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Japan', 97);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Jordan', 98);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Kazakhstan', 99);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Kenya', 100);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Kiribati', 101);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Korea', 102);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Kuwait', 103);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Kyrgyzstan', 104);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Laos', 105);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Latvia', 106);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Lebanon', 107);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Lesotho', 108);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Liberia', 109);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Libya', 110);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Liechtenstein', 111);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Lithuania', 112);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Luxembourg', 113);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Macao SAR', 114);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Macedonia', 115);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Madagascar', 116);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Malawi', 117);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Malaysia', 118);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Maldives', 119);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Mali', 120);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Malta', 121);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Martinique', 122);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Mauritania', 123);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Mauritius', 124);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Mayotte', 125);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Mexico', 126);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Micronesia', 127);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Moldova', 128);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Monaco', 129);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Mongolia', 130);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Montserrat', 131);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Morocco', 132);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Mozambique', 133);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Myanmar', 134);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Namibia', 135);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Nauru', 136);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Nepal', 137);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Netherlands', 138);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Netherlands Antilles', 139);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('New Caledonia', 140);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('New Zealand', 141);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Nicaragua', 142);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Niger', 143);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Nigeria', 144);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Niue', 145);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Norfolk Island', 146);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('North Korea', 147);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Norway', 148);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Oman', 149);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Pakistan', 150);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Panama', 151);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Papua New Guinea', 152);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Paraguay', 153);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Peru', 154);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Philippines', 155);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Pitcairn Islands', 156);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Poland', 157);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Portugal', 158);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Puerto Rico', 159);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Qatar', 160);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Reunion', 161);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Romania', 162);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Russia', 163);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Rwanda', 164);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Samoa', 165);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('San Marino', 166);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Sao Tome and Principe', 167);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Saudi Arabia', 168);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Senegal', 169);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Serbia and Montenegro', 170);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Seychelles', 171);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Sierra Leone', 172);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Singapore', 173);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Slovakia', 174);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Slovenia', 175);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Solomon Islands', 176);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Somalia', 177);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('South Africa', 178);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Spain', 179);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Sri Lanka', 180);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('St. Helena', 181);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('St. Kitts and Nevis', 182);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('St. Lucia', 183);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('St. Pierre and Miquelon', 184);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('St. Vincent & Grenadines', 185);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Sudan', 186);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Suriname', 187);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Swaziland', 188);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Sweden', 189);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Switzerland', 190);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Syria', 191);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Taiwan', 192);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Tajikistan', 193);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Tanzania', 194);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Thailand', 195);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Togo', 196);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Tokelau', 197);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Tonga', 198);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Trinidad and Tobago', 199);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Tunisia', 200);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Turkey', 201);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Turkmenistan', 202);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Turks and Caicos Islands', 203);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Tuvalu', 204);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Uganda', 205);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Ukraine', 206);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('United Arab Emirates', 207);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('United Kingdom', 208);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Uruguay', 209);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('USA', 210);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Uzbekistan', 211);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Vanuatu', 212);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Venezuela', 213);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Vietnam', 214);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Virgin Islands', 215);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Virgin Islands (British)', 216);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Wallis and Futuna', 217);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Yemen', 218);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Yugoslavia', 219);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Zambia', 220);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Zimbabwe', 221);
INSERT INTO `sbjbs_country` (`country`, `id`) VALUES ('Australia', 222);
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

INSERT INTO `sbjbs_currencies` (`sbcur_id`, `sbcur_symbol`, `sbcur_name`) VALUES (8, '$', 'USD');
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

INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (1, '2004-06-29');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (2, '06-29-2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (3, '29-06-2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (4, '29 Jun 2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (5, '29 June 2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (6, 'Jun 29th,2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (7, 'Tue Jun 29th,2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (8, 'Tuesday Jun 29th,2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (9, 'Tuesday June 29th,2004');
INSERT INTO `sbjbs_dateformats` (`sb_id`, `sb_format`) VALUES (10, '29 June 2004 Tuesday');
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

INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (1, 'High School or Equivalent (12th, Intermediate, Jr College)');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (2, 'Certification (Diploma)');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (3, 'Vocational (Diploma)');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (4, 'Some Tertiary Coursework Completed');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (5, 'Associates Degree');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (6, 'Bachelor\'s Degree-Graduate Degree (BA, BSc, BCom)');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (7, 'Master\'s Degree-Post Graduate (MA, MSc, MComm, LLB)');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (8, 'Doctorate');
INSERT INTO `sbjbs_degrees` (`sb_id`, `sb_degree`) VALUES (9, 'Professional-Engineering(BE or BTech)');
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

INSERT INTO `sbjbs_industries` (`sb_id`, `sb_name`) VALUES (8, 'IT/ Computers - Softwares');
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

INSERT INTO `sbjbs_languages` (`sb_id`, `sb_name`) VALUES (2, 'English');
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

INSERT INTO `sbjbs_levels` (`sb_id`, `sb_levelid`, `sb_levelname`, `sblevel_text`) VALUES (1, 1, 'Gold', 'Gold Mebers can ....');
INSERT INTO `sbjbs_levels` (`sb_id`, `sb_levelid`, `sb_levelname`, `sblevel_text`) VALUES (2, 2, 'Silver', 'Silver Members can ...');
INSERT INTO `sbjbs_levels` (`sb_id`, `sb_levelid`, `sb_levelname`, `sblevel_text`) VALUES (3, 3, 'Bronze', 'Bronze Members can ...');
# --------------------------------------------------------

#
# Table structure for table `sbjbs_locations`
#

DROP TABLE IF EXISTS `sbjbs_locations`;
CREATE TABLE `sbjbs_locations` (
  `sb_id` bigint(20) NOT NULL auto_increment,
  `sb_loc_name` varchar(255) default NULL,
  `sb_pid` bigint(20) default NULL,
  PRIMARY KEY  (`sb_id`)
) TYPE=MyISAM;

#
# Dumping data for table `sbjbs_locations`
#

INSERT INTO `sbjbs_locations` (`sb_id`, `sb_loc_name`, `sb_pid`) VALUES (8, 'USA', 0);
INSERT INTO `sbjbs_locations` (`sb_id`, `sb_loc_name`, `sb_pid`) VALUES (10, 'Arizona', 8);
INSERT INTO `sbjbs_locations` (`sb_id`, `sb_loc_name`, `sb_pid`) VALUES (12, 'New Hampshire', 8);
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

INSERT INTO `sbjbs_mailalert_set` (`sb_id`, `sb_uid`, `sb_cid`, `sb_loc_id`) VALUES (1, 10, '5,6,14', '1,8,9');
INSERT INTO `sbjbs_mailalert_set` (`sb_id`, `sb_uid`, `sb_cid`, `sb_loc_id`) VALUES (8, 12, '39', '4');
INSERT INTO `sbjbs_mailalert_set` (`sb_id`, `sb_uid`, `sb_cid`, `sb_loc_id`) VALUES (4, 10, '8', '9');
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

INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (3, 3, 'sbautomail@sbjobseekers.com', 'Update Company profile is waiting for approval', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>A company profile has been updated and is awaiting approval. company Id: %company_id% <BR>company name:%company_name% <BR>profile </FONT><A href="%company_profile_url%"><FONT face="Arial, Helvetica, sans-serif" size=2>url:%company_profile_url%</FONT></A><FONT face="Arial, Helvetica, sans-serif" size=2> <BR></FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>sbAutomail</FONT> </P>', 'yes', 'no');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (4, 4, 'password@sbjobseekers.com', 'Your password', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %title% %fname%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Here is your login information: <BR>Username: %username% <BR>Password: %password% <BR>Email: %email%</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;Login now at %login_url% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Thanks for being part of our website. </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards,<BR>Admin </FONT></P>', 'yes', 'yes');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (1, 1, 'welcome@sbjobseekers.com', 'Welcome to sbjobseekers.com', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %title% %fname% %lname%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Welcome to sbjobseekers.com. Your registration information is as follows: <BR>First: %fname% <BR>Last: %lname% <BR>Username: %username% <BR>Password: %password% <BR>Email: %email% <BR>Login: %login_url%</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Thanks for being part of our website.</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;Regards, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Admin </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Login url is %login_url%</FONT> </P>', 'yes', 'no');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (5, 5, 'sbautomail@sbjobseekers.com', 'New Job has been posted & awaiting your approval', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>A new job has been posted and is awaiting approval. <BR>Job id:%job_id% <BR>Job title:%job_title%<BR> job </FONT><A href="%job_url%"><FONT face="Arial, Helvetica, sans-serif" size=2>url:%job_url%</FONT></A><FONT face="Arial, Helvetica, sans-serif" size=2> <BR>company Id: %company_id% <BR></FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>sbAutomail</FONT> </P>', 'yes', 'no');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (7, 7, 'admin@sbjob_seekers.com', 'Comments posted to Admin', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %visitor_name%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Your comments have been posted to the Admin at sbjobseekers.com. Details of comments are <BR>visitor: %visitor_name% <BR>message date: %message_date% <BR>message title: %message_title% <BR>message text: %message_text% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Admin</FONT> </P>', 'yes', 'yes');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (6, 6, 'automail@sbjobseekers.com', 'Employer has updated a job', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Dear Admin </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Member %username% has updated %job_title% at sbjobseekers.com </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Automail</FONT> </P>', 'yes', 'yes');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (8, 8, 'automail@sbjobseekers.com', 'User Posted Comments', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi Admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>%visitor_name% has posted some comments at sbjobseekers.com. Details of comments are <BR>visitor: %visitor_name%<BR> message date: %message_date% <BR>message title: %message_title% <BR>message text: %message_text% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Automail </FONT></P>', 'yes', 'yes');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (11, 11, 'admin@sbjobseekers.com', 'Resume', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Respected Sir ,</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;%title% %fname% %lname% has sent resume for your kind attention. Please click the link to view the same.<BR> Resume URL: %resume_url% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>Admin</FONT> </P>', 'yes', 'yes');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (10, 10, 'confirmation@sbjobseekers.com', 'Your confirmation link to sbjobseekers.com', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Welcome to <A href="www.domain.com">sbjobseekers.com</A>. <BR>Your confirmation link is given below :<BR>Link: %signup_url% <BR>Email: %email% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Thanks for being part of our website.</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Admin </FONT></P>', 'yes', 'no');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (2, 2, 'sbautomail@sbjobseekers.com', 'Company profile is waiting for approval', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi admin, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>A new company profile has been posted and is awaiting approval. company Id: %company_id% <BR>company name:%company_name% <BR>profile </FONT><A href=" %company_profile_url%"><FONT face="Arial, Helvetica, sans-serif" size=2>url: %company_profile_url%</FONT></A><FONT face="Arial, Helvetica, sans-serif" size=2> </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>sbAutomail</FONT> </P>', 'yes', 'no');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (9, 9, 'refer@sbjobseekers.com', 'Your friend has reffered you', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Hi %friend_name%, </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>While surfing at sbjobseekers.com <VISITOR_NAME>has reffered following link to you. Just click the link below to access this. <BR>Job Title: %job_title%<BR>Job Id: %job_id%<BR>Check this link %job_url%<BR>You can have an account of your\'s at %signup_url%. </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards <BR>Admin</FONT> </P>', 'yes', 'yes');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (12, 12, 'sbautomail@sbjobseekers.com', 'Member requested Premium membership', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Dear Admin,</FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>&nbsp;%title% %fname% %lname% has requested for premium membership. username: %username% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>Admin</FONT> </P>', 'yes', 'yes');
INSERT INTO `sbjbs_mails` (`sb_id`, `sb_mailid`, `sb_fromid`, `sb_subject`, `sb_mail`, `sb_status`, `sb_html_format`) VALUES (13, 13, 'sbautomail@sbjobseekers.com', 'Mail alerts', '<P><FONT face="Arial, Helvetica, sans-serif" size=2>Dear %title% %fname% %lname% , </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>There are %jobcnt% job(s) posted in categories / locations you are interested in. These are<BR> %jobstr% </FONT></P>\r\n<P><FONT face="Arial, Helvetica, sans-serif" size=2>Regards, <BR>Admin</FONT> </P>', 'yes', 'no');
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

INSERT INTO `sbjbs_online` (`sb_id`, `sb_ip`, `sb_ontime`, `sb_uid`) VALUES (554, '127.0.0.1', 20041008130547, -1);
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

INSERT INTO `sbjbs_plans` (`id`, `credits`, `price`) VALUES (9, 20000, 65);
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

INSERT INTO `sbjbs_policies` (`sb_id`, `sb_legal`, `sb_privacy`, `sb_terms`, `sb_welcome_msg`) VALUES (1, 'Legal Polic\'ies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here Legal Policies Here ', 'Privace Pol\'icies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here Privace Policies Here ', 'Terms of u\'se Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here <br><br><b>Terms</b><br>Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here Terms of use Here ', '<b><font color="#0066CC" size="2" face="Courier New, Courier, mono">Welcome Message</font></b> \r\n<font color="#0066CC" size="2" face="Courier New, Courier, mono"><font color="#FF0000"><font color="#1188FF"><br>\r\nwelcome message welcome message welcome message welcome message welcome message \r\nwelcome message welcome message welcome message welcome message welcome message \r\nwelcome message welcome message welcome message welcome message </font></font> \r\n<p> <font color="#0066CC" size="2" face="Courier New, Courier, mono"><b>Welcome Message</b> welcome message \r\n  welcome message welcome message welcome message welcome message welcome message \r\n  welcome message welcome message welcome message welcome message welcome message \r\n  welcome message welcome message welcome message </font></p>\r\n');
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

INSERT INTO `sbjbs_references` (`sb_id`, `sb_resume_id`, `sb_name`, `sb_phone`, `sb_email`, `sb_company`, `sb_designation`, `sb_relation`) VALUES (37, 39, 'sa\'', 'as\'', '', '', '', 'professional');
INSERT INTO `sbjbs_references` (`sb_id`, `sb_resume_id`, `sb_name`, `sb_phone`, `sb_email`, `sb_company`, `sb_designation`, `sb_relation`) VALUES (38, 39, 'assa', 'asas', '', '', '', 'professional');
INSERT INTO `sbjbs_references` (`sb_id`, `sb_resume_id`, `sb_name`, `sb_phone`, `sb_email`, `sb_company`, `sb_designation`, `sb_relation`) VALUES (39, 39, 'aas', 'sa', '', '', '', 'professional');
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

INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (82, 2, 39, 'Basic - Familiar');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (79, 2, 37, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (77, 2, 37, 'Fluent - Wide Knowledge');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (78, 2, 37, 'Conversational - Advanced');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (17, 2, 15, 'Fluent - Wide Knowledge');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (18, 2, 15, 'Conversational - Advanced');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (19, 2, 15, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (20, 2, 15, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (21, 2, 19, 'Fluent - Wide Knowledge');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (22, 2, 19, 'Conversational - Advanced');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (23, 2, 19, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (24, 2, 19, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (81, 2, 39, 'Conversational - Advanced');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (80, 2, 37, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (76, 2, 36, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (75, 2, 36, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (74, 2, 36, 'Conversational - Advanced');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (73, 2, 36, 'Fluent - Wide Knowledge');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (45, 2, 25, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (46, 2, 25, 'Fluent - Wide Knowledge');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (47, 2, 25, 'Conversational - Limited');
INSERT INTO `sbjbs_resume_language` (`sb_id`, `sb_language_id`, `sb_resume_id`, `sb_proficiency`) VALUES (48, 2, 25, 'Conversational - Advanced');
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

INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (25, 6, 15, 'Beginners', 6, 2004, 'Less than 1 Year');
INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (26, 6, 19, 'Beginners', 6, 2004, 'Less than 1 Year');
INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (27, 6, 25, 'Beginners', 6, 2004, 'Less than 1 Year');
INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (28, 6, 36, 'Beginners', 6, 2004, 'Less than 1 Year');
INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (29, 6, 37, 'Beginners', 6, 2004, 'Less than 1 Year');
INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (30, 6, 39, 'Advance', 6, 2004, 'Less than 1 Year');
INSERT INTO `sbjbs_resume_skills` (`sb_id`, `sb_skill_id`, `sb_resume_id`, `sb_level`, `sb_last_month`, `sb_last_year`, `sb_experience`) VALUES (31, 6, 39, 'Advance', 1, 2004, 'Less than 1 Year');
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

INSERT INTO `sbjbs_skills` (`sb_id`, `sb_name`) VALUES (6, 'Inter Personnel');
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

INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (4, 'Red', 'FFFFFF', 'FFFFFF', 'F5F5F5', 'FFA8A8', 'FFD5D5', '990000', 'Arial', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '990000', '12', 'C33100', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (13, 'Australia (Gold, Green)', '00BB00', 'FFFFFF', 'FFFFBB', 'FFCC00', '00BB00', '000000', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '006600', '12', 'FFCC00', NULL, '000000', NULL, 'FFFF99', 'FFCCCC', 'FFDDDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (14, 'Green', 'FFFFFF', 'F4FFFA', 'F0FDE8', '0E6900', '0E6900', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'F0FDE8', 'Arial, Helvetica, sans-serif', '0E6900', '12', '073E00', NULL, 'FFFFFF', NULL, 'E7FCDA', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (15, 'Gray - Black', 'FFFFFF', 'FAFAFA', 'F5F5F5', 'cccccc', '363636', 'ffffff', 'Arial, Helvetica, sans-serif', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'FAFAFA', 'Arial, Helvetica, sans-serif', '990000', '12', '333333', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (16, 'Blue', 'ECF5FF', 'FFFFFF', 'F5F5F5', '0078CC', '3C9DFF', 'FFFFFF', 'Courier New, Courier, mono', '18', '333333', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '0023CD', '12', '0068C3', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (17, 'Blue Red', 'FFFFFF', 'FFFFFF', 'F5F5F5', 'CCCCCC', 'CF411D', 'FFFFFF', NULL, NULL, '333333', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', '00509F', '12', '004080', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (18, 'Yellow', 'FEFBEB', 'FEFBEB', 'FDF0D9', 'CC9933', 'E0AE2C', 'FFFFFF', NULL, NULL, '6B4418', 'Arial, Helvetica, sans-serif', '12', 'FDF0D9', 'Arial, Helvetica, sans-serif', '004080', '12', '9B0000', NULL, 'FFFFFF', NULL, 'FCE7BE', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (19, 'Canada,Dames,Swiss(Red,White)', 'FFF4F4', 'FFFFFF', 'FFF4F4', 'CE1D27', 'CE1D27', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'FFF4F4', 'Arial, Helvetica, sans-serif', 'CE1D27', '12', 'CE1D27', NULL, 'FFFFFF', NULL, 'FCEBEC', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (20, 'Germany (Gold, Red, Black)', 'EBAE18', 'FFFFFF', 'F5F5F5', 'CC2225', 'CC2225', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'F5F5F5', 'Arial, Helvetica, sans-serif', 'CC2225', '12', '000000', NULL, 'FFFFFF', NULL, 'EEEEEE', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (21, 'US (Blue,Red)', '1C237D', 'FFFFFF', 'E7E8FA', 'CE1D27', 'CE1D27', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'E7E8FA', 'Arial, Helvetica, sans-serif', 'CE1D27', '12', 'CE1D27', NULL, 'FFFFFF', NULL, 'CACCF4', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (22, 'UK (Red,Blue)', 'FE0000', 'FFFFFF', 'FFF0F0', '0B4199', '0000D9', 'FFFFFF', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'FFF0F0', 'Arial, Helvetica, sans-serif', '0B4199', '12', '0000D9', NULL, 'FFFFFF', NULL, 'FFDFDF', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (23, 'Netherlands (Orange)', 'FFFFFF', 'FFFFFF', 'FFF3E8', 'FF8306', 'FF6D0D', 'FFFFFF', 'Arial', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'FFF3E8', 'Arial, Helvetica, sans-serif', 'F0400D', '12', 'FF6D0D', NULL, 'FFFFFF', NULL, 'FFE7CE', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (24, 'Sweden (Yellow,Blue)', '00009B', 'FEFCED', 'FDF9D9', 'EBCE10', 'EBCE10', '000000', NULL, NULL, '000000', 'Arial, Helvetica, sans-serif', '12', 'FDF9D9', 'Arial, Helvetica, sans-serif', '00009B', '12', 'EBCE10', NULL, '000000', NULL, 'FCF7C9', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (25, 'New Zealand (Black,Gray)', 'FFFFFF', 'F5F5F5', 'E5E5E5', 'BBBBBB', '000000', 'FAFAFA', 'Arial, Helvetica, sans-serif', '12', '000000', 'Arial, Helvetica, sans-serif', '12', 'E5E5E5', 'Arial, Helvetica, sans-serif', '990000', '12', '000000', NULL, 'FAFAFA', NULL, 'DDDDDD', 'FFFFCC', 'FFFFDD');
INSERT INTO `sbjbs_styles` (`sb_id`, `sb_title`, `sb_page_bg`, `sb_table_bg`, `sb_inner_table_bg`, `sb_seperator`, `sb_title_bg`, `sb_title_font_color`, `sb_title_font`, `sb_title_font_size`, `sb_normal_font_color`, `sb_normal_font`, `sb_normal_font_size`, `sb_normal_table_bg`, `sb_link_font`, `sb_link_font_color`, `sb_link_font_size`, `sb_side_title_bg`, `sb_side_title_font`, `sb_side_title_font_color`, `sb_side_title_font_size`, `sb_sub_title_bg`, `sb_highlighted`, `sb_highlighted1`) VALUES (26, 'France (Blue)', 'F2F7FF', 'FFFFFF', 'F2F7FF', '0078CC', '0236AE', 'FFFFFF', 'Courier New, Courier, mono', '18', '333333', 'Arial, Helvetica, sans-serif', '12', 'F2F7FF', 'Arial, Helvetica, sans-serif', '0023CD', '12', '0236AE', NULL, 'FFFFFF', NULL, 'DFE9FF', 'FFFFCC', 'FFFFDD');
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

INSERT INTO `sbjbs_timeformats` (`sb_id`, `sb_format`) VALUES (1, '06:20 pm');
INSERT INTO `sbjbs_timeformats` (`sb_id`, `sb_format`) VALUES (2, '06:20 PM');
INSERT INTO `sbjbs_timeformats` (`sb_id`, `sb_format`) VALUES (3, '18:20');
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

INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (1, 'Alabama');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (2, 'Alaska');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (3, 'Arizona');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (4, 'Arkansas');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (5, 'California');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (6, 'Colorado');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (7, 'Connecticut');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (8, 'Delaware');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (9, 'Florida');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (10, 'Georgia');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (11, 'Hawaii');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (12, 'Idaho');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (13, 'Illinois');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (14, 'Indiana');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (15, 'Iowa');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (16, 'Kansas');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (17, 'Kentucky');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (18, 'Louisiana');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (19, 'Maine');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (20, 'Maryland');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (21, 'Massachusetts');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (22, 'Michigan');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (23, 'Minnesota');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (24, 'Mississippi');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (25, 'Missouri');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (26, 'Montana');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (27, 'Nebraska');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (28, 'Nevada');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (29, 'New Hampshire');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (30, 'New Jersey');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (31, 'New Mexico');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (32, 'New York');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (33, 'North Carolina');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (34, 'North Dakota');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (35, 'Ohio');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (36, 'Oklahoma');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (37, 'Oregon');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (38, 'Pennsylvania');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (39, 'Rhode Island');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (40, 'South Carolina');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (41, 'South Dakota');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (42, 'Tennessee');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (43, 'Texas');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (44, 'Utah');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (45, 'Vermont');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (46, 'Virginia');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (47, 'Washington');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (48, 'Washington DC');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (49, 'West Virginia');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (50, 'Wisconsin');
INSERT INTO `sbjbs_us_states` (`sb_id`, `sb_state`) VALUES (51, 'Wyoming');

ALTER TABLE `sbjbs_locations` ADD `sb_default` BIGINT DEFAULT '0' NOT NULL ;


