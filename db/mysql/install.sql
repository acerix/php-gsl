CREATE TABLE country (
`id` smallint(5) unsigned NOT NULL,
  common_name varchar(127) DEFAULT NULL,
  code2 char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  code3 char(3) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  latitude float NOT NULL,
  longitude float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO country (id, common_name, code2, code3, latitude, longitude) VALUES
(4, 'Afghanistan', 'AF', 'AFG', 33, 65),
(8, 'Albania', 'AL', 'ALB', 41, 20),
(10, 'Australian Antarctic Territory', 'AQ', 'ATA', -90, 0),
(12, 'Algeria', 'DZ', 'DZA', 28, 3),
(16, 'American Samoa', 'AS', 'ASM', -14.3333, -170),
(20, 'Andorra', 'AD', 'AND', 42.5, 1.5),
(24, 'Angola', 'AO', 'AGO', -12.5, 18.5),
(28, 'Antigua and Barbuda', 'AG', 'ATG', 17.05, -61.8),
(31, 'Azerbaijan', 'AZ', 'AZE', 40.5, 47.5),
(32, 'Argentina', 'AR', 'ARG', -34, -64),
(36, 'Australia', 'AU', 'AUS', -27, 133),
(40, 'Austria', 'AT', 'AUT', 47.3333, 13.3333),
(44, 'Bahamas, The', 'BS', 'BHS', 24.25, -76),
(48, 'Bahrain', 'BH', 'BHR', 26, 50.55),
(50, 'Bangladesh', 'BD', 'BGD', 24, 90),
(51, 'Armenia', 'AM', 'ARM', 40, 45),
(52, 'Barbados', 'BB', 'BRB', 13.1667, -59.5333),
(56, 'Belgium', 'BE', 'BEL', 50.8333, 4),
(60, 'Bermuda', 'BM', 'BMU', 32.3333, -64.75),
(64, 'Bhutan', 'BT', 'BTN', 27.5, 90.5),
(68, 'Bolivia', 'BO', 'BOL', -17, -65),
(70, 'Bosnia and Herzegovina', 'BA', 'BIH', 44, 18),
(72, 'Botswana', 'BW', 'BWA', -22, 24),
(74, 'Bouvet Island', 'BV', 'BVT', -54.4333, 3.4),
(76, 'Brazil', 'BR', 'BRA', -10, -55),
(84, 'Belize', 'BZ', 'BLZ', 17.25, -88.75),
(86, 'British Indian Ocean Territory', 'IO', 'IOT', -6, 71.5),
(90, 'Solomon Islands', 'SB', 'SLB', -8, 159),
(92, 'British Virgin Islands', 'VG', 'VGB', 18.5, -64.5),
(96, 'Brunei', 'BN', 'BRN', 4.5, 114.667),
(100, 'Bulgaria', 'BG', 'BGR', 43, 25),
(104, 'Myanmar (Burma)', 'MM', 'MMR', 22, 98),
(108, 'Burundi', 'BI', 'BDI', -3.5, 30),
(112, 'Belarus', 'BY', 'BLR', 53, 28),
(116, 'Cambodia', 'KH', 'KHM', 13, 105),
(120, 'Cameroon', 'CM', 'CMR', 6, 12),
(124, 'Canada', 'CA', 'CAN', 60, -95),
(132, 'Cape Verde', 'CV', 'CPV', 16, -24),
(136, 'Cayman Islands', 'KY', 'CYM', 19.5, -80.5),
(140, 'Central African Republic', 'CF', 'CAF', 7, 21),
(144, 'Sri Lanka', 'LK', 'LKA', 7, 81),
(148, 'Chad', 'TD', 'TCD', 15, 19),
(152, 'Chile', 'CL', 'CHL', -30, -71),
(156, 'China, People''s Republic of', 'CN', 'CHN', 35, 105),
(158, 'China, Republic of (Taiwan)', 'TW', 'TWN', 23.5, 121),
(162, 'Christmas Island', 'CX', 'CXR', -10.5, 105.667),
(166, 'Cocos (Keeling) Islands', 'CC', 'CCK', -12.5, 96.8333),
(170, 'Colombia', 'CO', 'COL', 4, -72),
(174, 'Comoros', 'KM', 'COM', -12.1667, 44.25),
(175, 'Mayotte', 'YT', 'MYT', -12.8333, 45.1667),
(178, 'Congo, (Brazzaville)', 'CG', 'COG', -1, 15),
(180, 'Congo, (Kinshasa)', 'CD', 'COD', 0, 25),
(184, 'Cook Islands', 'CK', 'COK', -21.2333, -159.767),
(188, 'Costa Rica', 'CR', 'CRI', 10, -84),
(191, 'Croatia', 'HR', 'HRV', 45.1667, 15.5),
(192, 'Cuba', 'CU', 'CUB', 21.5, -80),
(196, 'Cyprus', 'CY', 'CYP', 35, 33),
(203, 'Czech Republic', 'CZ', 'CZE', 49.75, 15.5),
(204, 'Benin', 'BJ', 'BEN', 9.5, 2.25),
(208, 'Denmark', 'DK', 'DNK', 56, 10),
(212, 'Dominica', 'DM', 'DMA', 15.4167, -61.3333),
(214, 'Dominican Republic', 'DO', 'DOM', 19, -70.6667),
(218, 'Ecuador', 'EC', 'ECU', -2, -77.5),
(222, 'El Salvador', 'SV', 'SLV', 13.8333, -88.9167),
(226, 'Equatorial Guinea', 'GQ', 'GNQ', 2, 10),
(231, 'Ethiopia', 'ET', 'ETH', 8, 38),
(232, 'Eritrea', 'ER', 'ERI', 15, 39),
(233, 'Estonia', 'EE', 'EST', 59, 26),
(234, 'Faroe Islands', 'FO', 'FRO', 62, -7),
(238, 'Falkland Islands (Islas Malvinas)', 'FK', 'FLK', -51.75, -59),
(239, 'South Georgia & South Sandwich Islands', 'GS', 'SGS', -54.5, -37),
(242, 'Fiji', 'FJ', 'FJI', -18, 175),
(246, 'Finland', 'FI', 'FIN', 64, 26),
(248, 'Aland', 'AX', 'ALA', 60, 20),
(250, 'France', 'FR', 'FRA', 46, 2),
(254, 'French Guiana', 'GF', 'GUF', 4, -53),
(258, 'French Polynesia', 'PF', 'PYF', -15, -140),
(260, 'French Southern and Antarctic Lands', 'TF', 'ATF', -43, 67),
(262, 'Djibouti', 'DJ', 'DJI', 11.5, 43),
(266, 'Gabon', 'GA', 'GAB', -1, 11.75),
(268, 'Georgia', 'GE', 'GEO', 42, 43.5),
(270, 'Gambia, The', 'GM', 'GMB', 13.4667, -16.5667),
(276, 'Germany', 'DE', 'DEU', 51, 9),
(288, 'Ghana', 'GH', 'GHA', 8, -2),
(292, 'Gibraltar', 'GI', 'GIB', 36.1833, -5.3667),
(296, 'Kiribati', 'KI', 'KIR', 1.4167, 173),
(300, 'Greece', 'GR', 'GRC', 39, 22),
(304, 'Greenland', 'GL', 'GRL', 72, -40),
(308, 'Grenada', 'GD', 'GRD', 12.1167, -61.6667),
(312, 'Guadeloupe', 'GP', 'GLP', 16.25, -61.5833),
(316, 'Guam', 'GU', 'GUM', 13.4667, 144.783),
(320, 'Guatemala', 'GT', 'GTM', 15.5, -90.25),
(324, 'Guinea', 'GN', 'GIN', 11, -10),
(328, 'Guyana', 'GY', 'GUY', 5, -59),
(332, 'Haiti', 'HT', 'HTI', 19, -72.4167),
(334, 'Heard Island and McDonald Islands', 'HM', 'HMD', -53.1, 72.5167),
(336, 'Vatican City', 'VA', 'VAT', 41.9, 12.45),
(340, 'Honduras', 'HN', 'HND', 15, -86.5),
(344, 'Hong Kong', 'HK', 'HKG', 22.25, 114.167),
(348, 'Hungary', 'HU', 'HUN', 47, 20),
(352, 'Iceland', 'IS', 'ISL', 65, -18),
(356, 'India', 'IN', 'IND', 20, 77),
(360, 'Indonesia', 'ID', 'IDN', -5, 120),
(364, 'Iran', 'IR', 'IRN', 32, 53),
(368, 'Iraq', 'IQ', 'IRQ', 33, 44),
(372, 'Ireland', 'IE', 'IRL', 53, -8),
(376, 'Israel', 'IL', 'ISR', 31.5, 34.75),
(380, 'Italy', 'IT', 'ITA', 42.8333, 12.8333),
(384, 'Cote d''Ivoire (Ivory Coast)', 'CI', 'CIV', 8, -5),
(388, 'Jamaica', 'JM', 'JAM', 18.25, -77.5),
(392, 'Japan', 'JP', 'JPN', 36, 138),
(398, 'Kazakhstan', 'KZ', 'KAZ', 48, 68),
(400, 'Jordan', 'JO', 'JOR', 31, 36),
(404, 'Kenya', 'KE', 'KEN', 1, 38),
(408, 'Korea, North', 'KP', 'PRK', 40, 127),
(410, 'Korea, South', 'KR', 'KOR', 37, 127.5),
(414, 'Kuwait', 'KW', 'KWT', 29.3375, 47.6581),
(417, 'Kyrgyzstan', 'KG', 'KGZ', 41, 75),
(418, 'Laos', 'LA', 'LAO', 18, 105),
(422, 'Lebanon', 'LB', 'LBN', 33.8333, 35.8333),
(426, 'Lesotho', 'LS', 'LSO', -29.5, 28.5),
(428, 'Latvia', 'LV', 'LVA', 57, 25),
(430, 'Liberia', 'LR', 'LBR', 6.5, -9.5),
(434, 'Libya', 'LY', 'LBY', 25, 17),
(438, 'Liechtenstein', 'LI', 'LIE', 47.1667, 9.5333),
(440, 'Lithuania', 'LT', 'LTU', 56, 24),
(442, 'Luxembourg', 'LU', 'LUX', 49.75, 6.1667),
(446, 'Macau', 'MO', 'MAC', 22.1667, 113.55),
(450, 'Madagascar', 'MG', 'MDG', -20, 47),
(454, 'Malawi', 'MW', 'MWI', -13.5, 34),
(458, 'Malaysia', 'MY', 'MYS', 2.5, 112.5),
(462, 'Maldives', 'MV', 'MDV', 3.25, 73),
(466, 'Mali', 'ML', 'MLI', 17, -4),
(470, 'Malta', 'MT', 'MLT', 35.8333, 14.5833),
(474, 'Martinique', 'MQ', 'MTQ', 14.6667, -61),
(478, 'Mauritania', 'MR', 'MRT', 20, -12),
(480, 'Mauritius', 'MU', 'MUS', -20.2833, 57.55),
(484, 'Mexico', 'MX', 'MEX', 23, -102),
(492, 'Monaco', 'MC', 'MCO', 43.7333, 7.4),
(496, 'Mongolia', 'MN', 'MNG', 46, 105),
(498, 'Moldova', 'MD', 'MDA', 47, 29),
(499, 'Montenegro', 'ME', 'MNE', 42, 19),
(500, 'Montserrat', 'MS', 'MSR', 16.75, -62.2),
(504, 'Morocco', 'MA', 'MAR', 32, -5),
(508, 'Mozambique', 'MZ', 'MOZ', -18.25, 35),
(512, 'Oman', 'OM', 'OMN', 21, 57),
(516, 'Namibia', 'NA', 'NAM', -22, 17),
(520, 'Nauru', 'NR', 'NRU', -0.5333, 166.917),
(524, 'Nepal', 'NP', 'NPL', 28, 84),
(528, 'Netherlands', 'NL', 'NLD', 52.5, 5.75),
(530, 'Netherlands Antilles', 'AN', 'ANT', 12.25, -68.75),
(533, 'Aruba', 'AW', 'ABW', 12.5, -69.9667),
(540, 'New Caledonia', 'NC', 'NCL', -21.5, 165.5),
(548, 'Vanuatu', 'VU', 'VUT', -16, 167),
(554, 'New Zealand', 'NZ', 'NZL', -41, 174),
(558, 'Nicaragua', 'NI', 'NIC', 13, -85),
(562, 'Niger', 'NE', 'NER', 16, 8),
(566, 'Nigeria', 'NG', 'NGA', 10, 8),
(570, 'Niue', 'NU', 'NIU', -19.0333, -169.867),
(574, 'Norfolk Island', 'NF', 'NFK', -29.0333, 167.95),
(578, 'Norway', 'NO', 'NOR', 62, 10),
(580, 'Northern Mariana Islands', 'MP', 'MNP', 15.2, 145.75),
(581, 'Midway Islands', 'UM', 'UMI', 19.2833, 166.6),
(583, 'Micronesia', 'FM', 'FSM', 6.9167, 158.25),
(584, 'Marshall Islands', 'MH', 'MHL', 9, 168),
(585, 'Palau', 'PW', 'PLW', 7.5, 134.5),
(586, 'Pakistan', 'PK', 'PAK', 30, 70),
(591, 'Panama', 'PA', 'PAN', 9, -80),
(598, 'Papua New Guinea', 'PG', 'PNG', -6, 147),
(600, 'Paraguay', 'PY', 'PRY', -23, -58),
(604, 'Peru', 'PE', 'PER', -10, -76),
(608, 'Philippines', 'PH', 'PHL', 13, 122),
(612, 'Pitcairn Islands', 'PN', 'PCN', -24, -128),
(616, 'Poland', 'PL', 'POL', 52, 20),
(620, 'Portugal', 'PT', 'PRT', 39.5, -8),
(624, 'Guinea-Bissau', 'GW', 'GNB', 12, -15),
(626, 'Timor-Leste (East Timor)', 'TL', 'TLS', -8.9, 125.7),
(630, 'Puerto Rico', 'PR', 'PRI', 18.25, -66.5),
(634, 'Qatar', 'QA', 'QAT', 25.5, 51.25),
(638, 'Reunion', 'RE', 'REU', -21.1, 55.6),
(642, 'Romania', 'RO', 'ROU', 46, 25),
(643, 'Russia', 'RU', 'RUS', 60, 100),
(646, 'Rwanda', 'RW', 'RWA', -2, 30),
(654, 'Saint Helena', 'SH', 'SHN', -15.9333, -5.7),
(659, 'Saint Kitts and Nevis', 'KN', 'KNA', 17.3333, -62.75),
(660, 'Anguilla', 'AI', 'AIA', 18.25, -63.1667),
(662, 'Saint Lucia', 'LC', 'LCA', 13.8833, -61.1333),
(666, 'Saint Pierre and Miquelon', 'PM', 'SPM', 46.8333, -56.3333),
(670, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 13.25, -61.2),
(674, 'San Marino', 'SM', 'SMR', 43.7667, 12.4167),
(678, 'Sao Tome and Principe', 'ST', 'STP', 1, 7),
(682, 'Saudi Arabia', 'SA', 'SAU', 25, 45),
(686, 'Senegal', 'SN', 'SEN', 14, -14),
(688, 'Serbia', 'RS', 'SRB', 44, 21),
(690, 'Seychelles', 'SC', 'SYC', -4.5833, 55.6667),
(694, 'Sierra Leone', 'SL', 'SLE', 8.5, -11.5),
(702, 'Singapore', 'SG', 'SGP', 1.3667, 103.8),
(703, 'Slovakia', 'SK', 'SVK', 48.6667, 19.5),
(704, 'Vietnam', 'VN', 'VNM', 16, 106),
(705, 'Slovenia', 'SI', 'SVN', 46, 15),
(706, 'Somalia', 'SO', 'SOM', 10, 49),
(710, 'South Africa', 'ZA', 'ZAF', -29, 24),
(716, 'Zimbabwe', 'ZW', 'ZWE', -20, 30),
(724, 'Spain', 'ES', 'ESP', 40, -4),
(736, 'Sudan', 'SD', 'SDN', 15, 30),
(740, 'Suriname', 'SR', 'SUR', 4, -56),
(744, 'Svalbard', 'SJ', 'SJM', 78, 20),
(748, 'Swaziland', 'SZ', 'SWZ', -26.5, 31.5),
(752, 'Sweden', 'SE', 'SWE', 62, 15),
(756, 'Switzerland', 'CH', 'CHE', 47, 8),
(760, 'Syria', 'SY', 'SYR', 35, 38),
(762, 'Tajikistan', 'TJ', 'TJK', 39, 71),
(764, 'Thailand', 'TH', 'THA', 15, 100),
(768, 'Togo', 'TG', 'TGO', 8, 1.1667),
(772, 'Tokelau', 'TK', 'TKL', -9, -172),
(776, 'Tonga', 'TO', 'TON', -20, -175),
(780, 'Trinidad and Tobago', 'TT', 'TTO', 11, -61),
(784, 'United Arab Emirates', 'AE', 'ARE', 24, 54),
(788, 'Tunisia', 'TN', 'TUN', 34, 9),
(792, 'Turkey', 'TR', 'TUR', 39, 35),
(795, 'Turkmenistan', 'TM', 'TKM', 40, 60),
(796, 'Turks and Caicos Islands', 'TC', 'TCA', 21.75, -71.5833),
(798, 'Tuvalu', 'TV', 'TUV', -8, 178),
(800, 'Uganda', 'UG', 'UGA', 1, 32),
(804, 'Ukraine', 'UA', 'UKR', 49, 32),
(807, 'Macedonia', 'MK', 'MKD', 41.8333, 22),
(818, 'Egypt', 'EG', 'EGY', 27, 30),
(826, 'United Kingdom', 'GB', 'GBR', 54, -2),
(831, 'Guernsey', 'GG', 'GGY', -49.5, -2.6),
(832, 'Jersey', 'JE', 'JEY', 49.2, -2.1),
(833, 'Isle of Man', 'IM', 'IMN', 54.2, -4.5),
(834, 'Tanzania', 'TZ', 'TZA', -6, 35),
(840, 'United States', 'US', 'USA', 38, -97),
(850, 'U.S. Virgin Islands', 'VI', 'VIR', 18.3333, -64.8333),
(854, 'Burkina Faso', 'BF', 'BFA', 13, -2),
(858, 'Uruguay', 'UY', 'URY', -33, -56),
(860, 'Uzbekistan', 'UZ', 'UZB', 41, 64),
(862, 'Venezuela', 'VE', 'VEN', 8, -66),
(876, 'Wallis and Futuna', 'WF', 'WLF', -13.3, -176.2),
(882, 'Samoa', 'WS', 'WSM', -13.5833, -172.333),
(887, 'Yemen', 'YE', 'YEM', 15, 48),
(894, 'Zambia', 'ZM', 'ZMB', -15, 30);

CREATE TABLE game (
`id` tinyint(3) unsigned NOT NULL,
  `name` varchar(127) NOT NULL,
  version varchar(31) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  version_url varchar(127) DEFAULT NULL,
  version_url_type enum('url','github') CHARACTER SET ascii COLLATE ascii_bin DEFAULT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO game (id, name, version, version_url, version_url_type, created, updated) VALUES
(1, 'Game', '0.1', NULL, NULL, '2019-04-20 16:20:00', NULL);

CREATE TABLE game_mode (
`id` smallint(5) unsigned NOT NULL,
  game_id tinyint(3) unsigned NOT NULL,
  `name` varchar(127) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO game_mode (id, game_id, name) VALUES
(1, 1, 'Beginner'),
(3, 1, 'Hard'),
(4, 1, 'Impossible'),
(2, 1, 'Normal');

CREATE TABLE `server` (
`id` mediumint(8) unsigned NOT NULL,
  game_id tinyint(3) unsigned NOT NULL,
  game_mode_id smallint(3) unsigned NOT NULL,
  `name` varchar(63) NOT NULL,
  `host` varchar(127) NOT NULL,
  `port` smallint(5) unsigned NOT NULL,
  country_id smallint(5) unsigned DEFAULT NULL,
  setting bit(3) NOT NULL DEFAULT b'0',
  latitude float(10,6) DEFAULT NULL,
  longitude float(10,6) DEFAULT NULL,
  `status` enum('new','online','timeout','dns fail','disconnected','reconnecting','disabled') CHARACTER SET ascii COLLATE ascii_bin NOT NULL DEFAULT 'new',
  latency smallint(5) unsigned DEFAULT NULL,
  players smallint(5) unsigned DEFAULT NULL,
  max_players smallint(5) unsigned NOT NULL,
  `password` varchar(127) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `session` binary(20) DEFAULT NULL,
  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE server_log (
`id` int(10) unsigned NOT NULL,
  server_id mediumint(8) unsigned NOT NULL,
  created timestamp(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  nonce binary(20) DEFAULT NULL,
  `status` enum('new','online') CHARACTER SET ascii COLLATE ascii_bin NOT NULL DEFAULT 'new',
  latency smallint(5) unsigned DEFAULT NULL,
  players smallint(5) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE server_setting (
`id` tinyint(2) unsigned NOT NULL,
  setting varchar(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO server_setting (id, setting) VALUES
(1, 'Dedicated'),
(2, 'Password'),
(3, 'Anti-Cheat');

ALTER TABLE country
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY code2 (code2), ADD UNIQUE KEY code3 (code3), ADD UNIQUE KEY common_name (common_name);

ALTER TABLE game
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

ALTER TABLE game_mode
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY game_mode_in_game (game_id,`name`), ADD KEY game_id (game_id);

ALTER TABLE server
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY game_id (game_id), ADD UNIQUE KEY game_mode_id (game_mode_id), ADD UNIQUE KEY country_id (country_id);

ALTER TABLE server_log
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY server_id (server_id);

ALTER TABLE server_setting
 ADD PRIMARY KEY (`id`);


ALTER TABLE country
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE game
MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE game_mode
MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE server
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE server_log
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE server_setting
MODIFY `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT;

ALTER TABLE game_mode
ADD CONSTRAINT game_mode_ibfk_1 FOREIGN KEY (game_id) REFERENCES game (`id`);

ALTER TABLE server
ADD CONSTRAINT server_ibfk_1 FOREIGN KEY (game_id) REFERENCES game (`id`),
ADD CONSTRAINT server_ibfk_2 FOREIGN KEY (game_mode_id) REFERENCES game_mode (`id`),
ADD CONSTRAINT server_ibfk_3 FOREIGN KEY (country_id) REFERENCES country (`id`);

ALTER TABLE server_log
ADD CONSTRAINT server_log_ibfk_1 FOREIGN KEY (server_id) REFERENCES server (`id`);
