
DROP TABLE IF EXISTS `tb_auto_news`;
CREATE TABLE `tb_auto_news` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `title` varchar(200) NOT NULL,
    `description` varchar(200) NOT NULL,
    `picurl` varchar(200) NOT NULL,
    `url` varchar(200) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `tb_kewords_article`;
CREATE TABLE `tb_kewords_article` (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `keywords` varchar(200) NOT NULL,
    `article` varchar(1000) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
