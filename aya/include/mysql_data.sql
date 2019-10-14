-- 我的网站 系统数据备份 
-- 生成日期:2015/11/08 22:30
-- ----------------------------------------
-- 警告!修改本文件的任何部分,将有可能导致恢复失败!
-- ----------------------------------------

DROP TABLE IF EXISTS `aya3_apage_12`;

CREATE TABLE `aya3_apage_12` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO aya3_apage_12 VALUES('1','<p>都谢啦</p>','我的爱情');

DROP TABLE IF EXISTS `aya3_article_1`;

CREATE TABLE `aya3_article_1` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `keyword` varchar(100) NOT NULL,
  `cs` varchar(250) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `note` char(255) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `tag` varchar(100) NOT NULL,
  `color` varchar(12) NOT NULL,
  `original` tinyint(1) NOT NULL DEFAULT '0',
  `ttaea` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `hits` (`hits`),
  KEY `sign` (`sign`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO aya3_article_1 VALUES('3','admin','1436437636','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果1','136','','','1507/10/14365110181974.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','5','金砖,国家,二战','','0','1507/09/14364399328581.gif|');

INSERT INTO aya3_article_1 VALUES('4','admin','1436512033','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果2','1','','','1507/10/14365119613963.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('5','admin','1436512083','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果3','0','','','1507/10/14365120826594.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('6','admin','1436512091','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果4','0','','','1507/10/14365120901941.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('7','admin','1436512097','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果5','1','','','1507/10/14365120961940.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('8','admin','1436512118','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果6','6','','','1507/10/14365121171339.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('9','admin','1436512128','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果7','1','','','1507/10/14365121277081.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('10','admin','1436512136','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果8','8','','','1507/10/14365121352789.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('11','admin','1436512400','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果9','1','','','1507/10/14365123993397.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('12','admin','1436512409','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果10','1','','','1507/10/14365124086826.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('13','admin','1436512415','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果11','2','','','1507/10/14365124143021.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('14','admin','1436512426','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果12','18','','','1507/10/14365124243218.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

INSERT INTO aya3_article_1 VALUES('15','admin','1436512447','<p>据新华社电，金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张。</p><p>在讨论全球政治与经济问题时，习近平强调，要构建以合作共赢为核心的新型国家关系。金砖国家要坚持和平发展，不把自身意志强加于人，秉持互尊互信，合作共赢。要坚定遵循多边主义，珍视第二次世界大战胜利成果，维护联合国宪章宗旨和原则。要改革和完善全球经济治理，推动更多国家支持金砖国家新开发银行、应急储备安排、“一带一路”、亚洲基础设施投资银行、丝路基金等倡议，为世界经济增长和国际金融货币体系改革提供动力。要建立新型的全球发展伙伴关系，敦促发达国家承担应有责任，帮助发展中国家增强发展能力，缩小南北差距，加强南南合作，在互利共赢基础上实现联合自强。</p><p>在讨论金砖国家合作议题时，习近平指出，各方要落实金砖国家新开发银行和应急储备安排等重大成果倡议，彰显金砖国家执行力。要规划重点合作领域，加强金砖国家经济伙伴战略同各成员发展规划对接，增强金砖国家向心力。要发掘各自优势和潜力，开展创新合作和产能合作，加强金砖国家竞争力。要追求人类公平正义和全球关系民主化，坚持共同而有区别的责任原则，支持联合国制定可持续发展目标，增进人类福祉，从而提升金砖国家感召力。</p><p>会晤结束后，5国领导人出席了《金砖国家成员国外交部关于建立金砖国家联合网站的谅解备忘录》、《金砖国家政府间文化合作协定》、《金砖国家银行合作机制与金砖国家新开发银行开展合作的谅解备忘录》等合作文件签字仪式。会议发表《乌法宣言》及行动计划。</p><p>王沪宁、栗战书、杨洁篪、周小川等出席上述活动。</p>','金砖国家要共同维护二战胜利成果13','40','','','1507/10/14365124465980.jpg','','金砖国家领导人第七次会晤在俄罗斯乌法举行。中国国家主席习近平、俄罗斯总统普京、巴西总统罗塞夫、印度总理莫迪、南非总统祖马出席。习近平在题为《共建伙伴关系共创美好未来》的主旨讲话中，就加强金砖国家伙伴关系提出四点主张','','0','金砖,国家,二战','','0','');

DROP TABLE IF EXISTS `aya3_book`;

CREATE TABLE `aya3_book` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `aya3_channel`;

CREATE TABLE `aya3_channel` (
  `channelid` smallint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(20) NOT NULL DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `language` varchar(10) NOT NULL DEFAULT '',
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  `isblank` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `dirname` varchar(20) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `hide_pc` tinyint(1) NOT NULL DEFAULT '0',
  `hide_tc` tinyint(1) NOT NULL DEFAULT '0',
  `hide_wx` tinyint(1) NOT NULL DEFAULT '0',
  `parentid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `pagesize` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `table` varchar(50) NOT NULL DEFAULT '',
  `orderby` varchar(250) NOT NULL DEFAULT '',
  `pv` text NOT NULL,
  `config` varchar(255) NOT NULL DEFAULT '',
  `comment` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`channelid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO aya3_channel VALUES('1','article','文章','dem_wenzhang/','zh-cn','3','0','dem_wenzhang','','','0','0','0','0','12','article_1','','','title','0');

INSERT INTO aya3_channel VALUES('2','product','产品','dem_chanpin/','zh-cn','2','0','dem_chanpin','','','0','0','0','0','20','product_2','','','thumb','2');

INSERT INTO aya3_channel VALUES('3','picture','图片','dem_pic/','zh-cn','1','0','dem_pic','','','0','0','0','0','20','picture_3','','','thumb','2');

INSERT INTO aya3_channel VALUES('4','home','首页','dem_home/','zh-cn','4','0','dem_home','','','0','0','0','0','0','','','','','0');

INSERT INTO aya3_channel VALUES('5','video','视频','dem_video/','zh-cn','0','0','dem_video','','','0','0','0','0','20','video_5','','','thumb','2');

INSERT INTO aya3_channel VALUES('6','epage','关于','dem_guanyu/','zh-cn','0','0','dem_guanyu','','','0','0','0','0','0','epage','','','','0');

INSERT INTO aya3_channel VALUES('7','member','会员中心','dem_ucenter/','zh-cn','0','0','dem_ucenter','','','1','1','1','0','0','member','','','','0');

INSERT INTO aya3_channel VALUES('8','search','搜索','dem_search/','zh-cn','0','0','dem_search','','','1','1','1','0','20','search','','','','0');

INSERT INTO aya3_channel VALUES('9','book','留言','dem_book/','zh-cn','0','0','dem_book','','','0','0','0','0','0','book','','','','0');

INSERT INTO aya3_channel VALUES('10','atag','标签','dem_tag/','zh-cn','0','0','dem_tag','','','0','1','1','0','20','tag','','','','0');

INSERT INTO aya3_channel VALUES('11','sitemap','地图','dem_sitemap/','zh-cn','0','0','dem_sitemap','','','0','0','0','0','0','','','','','0');

INSERT INTO aya3_channel VALUES('12','apage','独立页','dem_page/','zh-cn','0','0','dem_page','','','0','0','0','0','0','apage_12','','','','0');

DROP TABLE IF EXISTS `aya3_class`;

CREATE TABLE `aya3_class` (
  `itemid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  `channelid` smallint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `aya3_comment`;

CREATE TABLE `aya3_comment` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL DEFAULT '0',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `channelid` mediumint(8) NOT NULL DEFAULT '0',
  `itemid_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`),
  KEY `itemid_by` (`itemid_by`),
  KEY `channelid` (`channelid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `aya3_epage`;

CREATE TABLE `aya3_epage` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `channelid` mediumint(8) NOT NULL,
  PRIMARY KEY (`itemid`),
  UNIQUE KEY `channelid` (`channelid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO aya3_epage VALUES('1','关于AyaCMS','<p>AyaCMS 3.1.0 (2015-07-16)<br/></p><p>AyaCMS,Php+MySQL环境下的开源建站系统.</p><p>支持模板可视化,标签可视化操作.拖拽排版,所见即所得;</p><p>支持电脑,移动设备,微信个性设置;</p><p>支持多语言建站;</p><p>支持自定义表单;</p><p>沿承v2.0的简洁高效,继续打造便捷的网站建设方案.</p><p>安装方法:</p><p>1,需要服务器环境: php5.3+,mysql 5.0+;</p><p>2,解压后上传到您的网站空间;</p><p>3,输入您的站点域名,自动进入安装界面;</p><p>4,完成设置项目;</p><p>5,点击&quot;同意协议,并安装&quot;.</p><p>演示地址:</p><p>http://demo.ayacms.com</p><p>官方地址:</p><p>http://www.ayacms.com</p><p>QQ讨论群:</p><p>AyaCMS欢乐群:147622478</p><p>AyaCMS技术群①:35018781&nbsp;</p><p>AyaCMS技术群②:44178995</p><p>2015.7.16 v3.1.0</p><p>1,增加微信公众号的支持</p><p>2015.6.30 v3.0.0</p><p>1,新内核,新气象;</p><p>2,可视,拖拽,便捷,速度一个也不能少.</p><p>2014.7.10 v2.1.2发布.</p><p>1,模板优化.</p><p>2014.6.29 v2.1.1发布.</p><p>1,上传组件支持更多浏览器.</p><p>2014.6.25 v2.1.0发布.</p><p>1,增加两个模型;</p><p>2,增加留言功能;</p><p>3,增加可视化修饰标签N个;</p><p>2014.6.17 v2.0.0发布.</p><p>1,支持多语言建站;</p><p>2,模板新机制,支持一个模板建站;</p><p>2014.6.2 v2.0.0(测试版) 发布.</p><p>1,全新开发,代码改动率99%;</p><p>2,秉承前版,一如既往直观高效;</p><p>3,架构优化,使用和开发更便捷;</p><p>4,增加自定义表单;</p><p>5,增加响应式布局,方便手机浏览.</p><p>2012.8.20 v1.4.2发布.</p><p>1,增加站内留言功能;</p><p>2,部分模块优化,操作更为流畅;</p><p>3,伪静态规则重写,无须二次生成;</p><p>4,模板结构调整,制作更为快捷.</p><p>2012.7.24 v1.4.1发布.</p><p>1,优化系统架构.</p><p>2012.7.16 v1.4.0发布.</p><p>1,支持投稿;</p><p>2,支持应用的在线安装;</p><p>3,增强栏目管理员权限;</p><p>4,增加3个模型;</p><p>5,后台流程优化.</p><p>2012.4.19 v1.3.2发布.</p><p>1,对tag增加样式支持;</p><p>2,支持客户端风格切换;</p><p>3,增加安全部署权限;</p><p>4,增加5个模块;</p><p>5,更新为ueditor编辑器</p><p>2012.3.22 v1.3.1发布.</p><p>1,增加4个mod,3个theme,6个tag,n个pane;</p><p>2,提供AyaCMS扩展版供用户选择使用.</p><p>2012.3.6 v1.3.0发布.</p><p>1,系统架构重写,加入更多开放元素;</p><p>2,集成模块重写;</p><p>3,更新ke编辑器;</p><p>4,pane从part分离,成为单独设计元素.</p><p>2011.8.24 v1.2.1发布.</p><p>1,加强缓存功能,页面打开更快;</p><p>2,增加3套风格;</p><p>3,增加5个diy控件.</p><p>2011.8.3 v1.2.0发布.</p><p>1,调整架构,允许为模块指定唯一入口;</p><p>2,测试数据将在线获取,不再集成;</p><p>3,部分tag功能得到加强;</p><p>4,增加至16个模块;</p><p>5,界面上的细节处理,如标注等.</p><p>2011.6.18 v1.1.0发布.</p><p>1,diy与tag整合,方便记忆和使用;</p><p>2,part及tag碎片被缓存,降低了服务器耗损,源码更加整洁;</p><p>3,diy功能优化,取消对设计元素的依赖.降低开发门槛;</p><p>4,page样式表与数据处理层分离;</p><p>5,部分用户体验处理.</p><p>2011.5.18 v1.0.0发布.&nbsp;</p><p>www.ayacms.com</p><p>2015年7月16日</p>','6');

DROP TABLE IF EXISTS `aya3_field`;

CREATE TABLE `aya3_field` (
  `itemid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tb` varchar(30) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT '',
  `html` varchar(30) NOT NULL DEFAULT '',
  `default_value` text NOT NULL,
  `option_value` text NOT NULL,
  `width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `input_limit` tinyint(1) NOT NULL DEFAULT '0',
  `addition` varchar(255) NOT NULL DEFAULT '',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `front` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  `vmin` int(10) unsigned NOT NULL DEFAULT '0',
  `vmax` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO aya3_field VALUES('2','article_1','ttaea','妈呀','','','thumb','','','0','0','0','','1','0','1','0','100');

INSERT INTO aya3_field VALUES('3','product_2','ykuok','来源','','','text','','','0','0','0','','1','1','0','0','100');

DROP TABLE IF EXISTS `aya3_link`;

CREATE TABLE `aya3_link` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `titles` text NOT NULL,
  `contents` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `openlinks` text NOT NULL,
  `urls` text NOT NULL,
  `note` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO aya3_link VALUES('1','AyaCMS|AyaCMS|操你妈|流氓||||||||||||||||','AyaCMS官方站点. Ayacms是一款还凑合的建站软体.|AyaCMS官方站点. Ayacms是一款还凑合的建站软体.|一个相当流氓的网站|||||||||||||||||','1437364154','http://www.ayacms.com|http://www.ayacms.com|http://www.baidu.com|http://www.360.cn||||||||||||||||','|||||||||||||||||||','页尾友情链接');

DROP TABLE IF EXISTS `aya3_member`;

CREATE TABLE `aya3_member` (
  `itemid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `regtime` int(10) NOT NULL DEFAULT '0',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `groupid` tinyint(2) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `post_sum` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `last_post` int(10) NOT NULL DEFAULT '0',
  `aya_a` int(10) NOT NULL DEFAULT '0',
  `aya_b` int(10) NOT NULL DEFAULT '0',
  `aya_c` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO aya3_member VALUES('1','admin','d957059971c79d3273f1a5a119d3196e','1446756589','0','2','','0','0','2700','135','27');

DROP TABLE IF EXISTS `aya3_pic`;

CREATE TABLE `aya3_pic` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `titles` text NOT NULL,
  `contents` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `openlinks` text NOT NULL,
  `urls` text NOT NULL,
  `note` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO aya3_pic VALUES('1','星际争霸2-1|星际争霸2-2|星际争霸2-3|星际争霸2-4|星际争霸2-5|星际争霸2-6||||','|||||||||','1436430498','|||||||||','1507/16/14370266786325.jpg|1507/16/14370266831400.jpg|1507/16/14370260411759.jpg|1507/20/14373673662789.jpg|1507/20/14373673743030.jpg|1507/20/14373673801704.jpg||||','供首页幻灯片调用');

INSERT INTO aya3_pic VALUES('2','我的网站|||||||||','|||||||||','1437369519','/|||||||||','1507/20/14373719197252.png|||||||||','网站LOGO');

DROP TABLE IF EXISTS `aya3_picture_3`;

CREATE TABLE `aya3_picture_3` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `keyword` varchar(100) NOT NULL,
  `cs` varchar(250) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `note` char(255) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `tag` varchar(100) NOT NULL,
  `color` varchar(12) NOT NULL,
  `pics` text NOT NULL,
  `original` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`itemid`),
  KEY `hits` (`hits`),
  KEY `sign` (`sign`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO aya3_picture_3 VALUES('5','admin','1436769019','<p><span style=\"color: rgb(51, 51, 51); font-family: &#39;Helvetica Neue&#39;, Helvetica, Tahoma, Arial, sans-serif; font-size: 14px; line-height: 28px; text-indent: 28px; background-color: rgb(255, 255, 255);\">阿雅简介： 阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查》主持人之一。</span></p>','阿雅2','17','','','1507/20/14373689708529.jpg','','阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查》主持人之一','','0','','','1507/13/14367690169281.jpg|,1507/13/14367692134367.jpg|','0');

INSERT INTO aya3_picture_3 VALUES('6','admin','1437368780','<p><span style=\"color: rgb(51, 51, 51); font-family: &#39;Helvetica Neue&#39;, Helvetica, Tahoma, Arial, sans-serif; font-size: 13px; line-height: 20px; background-color: rgb(255, 255, 255);\">阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查》主持人之一</span></p>','阿雅3','2','','','1507/20/14373687767572.jpg','','','','0','','','1507/20/14373687325623.jpg|,1507/20/14373687682845.jpg|','0');

INSERT INTO aya3_picture_3 VALUES('4','admin','1436671438','<p>阿雅简介： 阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查》主持人之一。&nbsp;</p>','阿雅','57','','','1507/12/14366714094831.jpg','','阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查》主持人之一','','0','','','1507/12/14367025971802.jpg|大美女,1507/12/14367026205855.jpg|胜利,1507/12/14367027865183.jpg|美丽的女神,1507/12/14367028677849.jpg|气质,1507/12/14367029845836.jpg|胜利,1507/12/14367030143404.jpg|性感','0');

INSERT INTO aya3_picture_3 VALUES('7','admin','1437368832','<p><span style=\"color: rgb(51, 51, 51); font-family: &#39;Helvetica Neue&#39;, Helvetica, Tahoma, Arial, sans-serif; font-size: 13px; line-height: 20px; background-color: rgb(255, 255, 255);\">阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查》主持人之一</span></p>','阿雅4','5','','','1507/20/14373687967380.jpg','','','','0','','','1507/20/14373688074875.jpg|,1507/20/14373688182857.jpg|','0');

INSERT INTO aya3_picture_3 VALUES('8','admin','1437368866','<p><span style=\"color: rgb(51, 51, 51); font-family: &#39;Helvetica Neue&#39;, Helvetica, Tahoma, Arial, sans-serif; font-size: 13px; line-height: 20px; background-color: rgb(255, 255, 255);\">阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查》主持人之一</span></p>','阿雅5','4','','','1507/20/14373688477202.jpg','','','','0','','','1507/20/14373688528086.jpg|,1507/20/14373688563688.jpg|','0');

INSERT INTO aya3_picture_3 VALUES('9','admin','1437368901','<p><span style=\"color: rgb(51, 51, 51); font-family: &#39;Helvetica Neue&#39;, Helvetica, Tahoma, Arial, sans-serif; font-size: 13px; line-height: 20px; background-color: rgb(255, 255, 255);\"><img width=\"530\" height=\"340\" src=\"http://api.map.baidu.com/staticimage?center=116.404,39.915&zoom=10&width=530&height=340&markers=116.404,39.915\"/>阿雅是著名的台湾女歌手与娱乐节目主持人，主播《娱乐新闻》、综艺节目《我猜我猜我猜猜猜》外景主持人、《马上大搜查<img src=\"/ueditor/php/upload/image/20151107/1446882300281083.jpg\" title=\"1446882300281083.jpg\" alt=\"DSC001.jpg\"/>》主持人之一</span></p>','阿雅6','6','','','1507/20/14373689556117.jpg','','','','0','','','1507/20/14373688915689.jpg|,1507/20/14373689001252.jpg|','0');

DROP TABLE IF EXISTS `aya3_poll`;

CREATE TABLE `aya3_poll` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `polls` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `content` text NOT NULL,
  `ty` tinyint(2) NOT NULL DEFAULT '0',
  `jy` varchar(50) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO aya3_poll VALUES('1','网站调查','1437363655','首页用 喜欢AyaCMS吗?','3|0|0|1|0|0|0|0|0|0','喜欢|一般喜欢|很喜欢|喜欢极了|喜欢死了|||||','你喜欢AyaCMS吗?','1','1437381000Mozilla/5.0 (Windows NT 6.1; WOW64) Appl');

DROP TABLE IF EXISTS `aya3_product_2`;

CREATE TABLE `aya3_product_2` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
  `vurl` varchar(255) NOT NULL,
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `keyword` varchar(100) NOT NULL,
  `cs` varchar(250) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `note` char(255) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `tag` varchar(100) NOT NULL,
  `color` varchar(12) NOT NULL,
  `pics` text NOT NULL,
  `original` tinyint(1) NOT NULL DEFAULT '0',
  `price` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `ykuok` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `hits` (`hits`),
  KEY `sign` (`sign`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO aya3_product_2 VALUES('2','admin','1436517128','八个美白肌肤的秘诀：<br/>一：注意劳动保护：在室外劳动时，一定要避免直接在阳光下曝晒，可在暴露部位搽一些防晒增白霜。<br/>二：饮食宜合理：少吃食盐，以减少黑色素的形成。平时要多饮水，多吃新鲜蔬菜，多吃、胡萝卜及各种水果。<br/>三：禁用含有雌激素的软膏或化妆品：原因是雌激素可促进黑色素形成。<br/>四：常服大剂量维生素C：维生素C能清除皮肤细胞中的自由基，达到美白肌肤的效果。<br/>五：用鸡蛋清和蜂蜜：睡前取鸡蛋清，用两手掌揉搓，涂脸部过1－2分钟后，用热毛巾擦净，然后再涂蜂蜜，翌日早晨洗净，能使皮肤细嫩、白晳。<br/>六：用银杏仁可起到增白作用：取银杏仁600克去皮去核，晒干研细末，加蜂蜜或鸡蛋调和。晚上涂手和脸部，翌日早晨洗掉，能防止或减少皱纹。<br/>七：服用芦荟汁：长期服用芦荟汁，能使皮肤增白，身体苗条在口服芦荟汁的同时再涂芦荟，效果更佳。\r\n八：白茯苓加蜜可增白皮肤：取白茯苓粉，白蜜调和，晚上涂脸部，翌日早晨洗净，涂，就可见效。','诗婷露雅玫瑰果美白护肤品套装补水淡斑淡化痘印黄气提亮肤色乳液','','155','','','1507/10/14365156654365.jpg','','诗婷露雅正品 诗婷露雅套装 诗婷露雅坚果 诗婷露雅鳄梨 诗婷露雅美白 诗婷露雅坚果套 诗婷露雅坚果套装','','0','诗婷,露雅,坚果','','1507/10/14365171108587.png|','0','0.00','不知道');

DROP TABLE IF EXISTS `aya3_search`;

CREATE TABLE `aya3_search` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channelid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `itemid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `sign` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_time` (`posttime`),
  KEY `pid` (`itemid`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

INSERT INTO aya3_search VALUES('5','1','3','1436437636','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('2','1','2','1436419929','我爱中华','');

INSERT INTO aya3_search VALUES('6','1','4','1436512033','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('7','1','5','1436512083','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('8','1','6','1436512091','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('9','1','7','1436512097','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('10','1','8','1436512118','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('11','1','9','1436512128','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('12','1','10','1436512136','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('13','1','11','1436512400','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('14','1','12','1436512409','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('15','1','13','1436512415','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('16','1','14','1436512426','金砖国家要共同维护二战胜利成果123','');

INSERT INTO aya3_search VALUES('17','1','15','1436512447','金砖国家要共同维护二战胜利成果','');

INSERT INTO aya3_search VALUES('18','2','2','1436517128','诗婷露雅玫瑰果美白护肤品套装补水淡斑淡化痘印黄气提亮肤色乳液','');

INSERT INTO aya3_search VALUES('22','3','5','1436769019','阿雅2','');

INSERT INTO aya3_search VALUES('21','3','4','1436671438','阿雅','');

INSERT INTO aya3_search VALUES('23','5','1','1437021694','MC我的世界-彩芸娱乐','');

INSERT INTO aya3_search VALUES('24','3','6','1437368780','阿雅3','');

INSERT INTO aya3_search VALUES('25','3','7','1437368832','阿雅4','');

INSERT INTO aya3_search VALUES('26','3','8','1437368866','阿雅5','');

INSERT INTO aya3_search VALUES('27','3','9','1437368901','阿雅6','');

DROP TABLE IF EXISTS `aya3_tag`;

CREATE TABLE `aya3_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  `channelid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `itemid` mediumint(8) NOT NULL DEFAULT '0',
  `sign` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `posttime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `post_time` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

INSERT INTO aya3_tag VALUES('4','金砖','1','3','','金砖国家要共同维护二战胜利成果','1436511020');

INSERT INTO aya3_tag VALUES('5','国家','1','3','','金砖国家要共同维护二战胜利成果','1436511020');

INSERT INTO aya3_tag VALUES('6','二战','1','3','','金砖国家要共同维护二战胜利成果','1436511020');

INSERT INTO aya3_tag VALUES('7','金砖','1','4','','金砖国家要共同维护二战胜利成果','1436512033');

INSERT INTO aya3_tag VALUES('8','国家','1','4','','金砖国家要共同维护二战胜利成果','1436512033');

INSERT INTO aya3_tag VALUES('9','二战','1','4','','金砖国家要共同维护二战胜利成果','1436512033');

INSERT INTO aya3_tag VALUES('10','金砖','1','5','','金砖国家要共同维护二战胜利成果','1436512083');

INSERT INTO aya3_tag VALUES('11','国家','1','5','','金砖国家要共同维护二战胜利成果','1436512083');

INSERT INTO aya3_tag VALUES('12','二战','1','5','','金砖国家要共同维护二战胜利成果','1436512083');

INSERT INTO aya3_tag VALUES('13','金砖','1','6','','金砖国家要共同维护二战胜利成果','1436512091');

INSERT INTO aya3_tag VALUES('14','国家','1','6','','金砖国家要共同维护二战胜利成果','1436512091');

INSERT INTO aya3_tag VALUES('15','二战','1','6','','金砖国家要共同维护二战胜利成果','1436512091');

INSERT INTO aya3_tag VALUES('16','金砖','1','7','','金砖国家要共同维护二战胜利成果','1436512097');

INSERT INTO aya3_tag VALUES('17','国家','1','7','','金砖国家要共同维护二战胜利成果','1436512097');

INSERT INTO aya3_tag VALUES('18','二战','1','7','','金砖国家要共同维护二战胜利成果','1436512097');

INSERT INTO aya3_tag VALUES('19','金砖','1','8','','金砖国家要共同维护二战胜利成果','1436512118');

INSERT INTO aya3_tag VALUES('20','国家','1','8','','金砖国家要共同维护二战胜利成果','1436512118');

INSERT INTO aya3_tag VALUES('21','二战','1','8','','金砖国家要共同维护二战胜利成果','1436512118');

INSERT INTO aya3_tag VALUES('22','金砖','1','9','','金砖国家要共同维护二战胜利成果','1436512128');

INSERT INTO aya3_tag VALUES('23','国家','1','9','','金砖国家要共同维护二战胜利成果','1436512128');

INSERT INTO aya3_tag VALUES('24','二战','1','9','','金砖国家要共同维护二战胜利成果','1436512128');

INSERT INTO aya3_tag VALUES('25','金砖','1','10','','金砖国家要共同维护二战胜利成果','1436512136');

INSERT INTO aya3_tag VALUES('26','国家','1','10','','金砖国家要共同维护二战胜利成果','1436512136');

INSERT INTO aya3_tag VALUES('27','二战','1','10','','金砖国家要共同维护二战胜利成果','1436512136');

INSERT INTO aya3_tag VALUES('28','金砖','1','11','','金砖国家要共同维护二战胜利成果','1436512400');

INSERT INTO aya3_tag VALUES('29','国家','1','11','','金砖国家要共同维护二战胜利成果','1436512400');

INSERT INTO aya3_tag VALUES('30','二战','1','11','','金砖国家要共同维护二战胜利成果','1436512400');

INSERT INTO aya3_tag VALUES('31','金砖','1','12','','金砖国家要共同维护二战胜利成果','1436512409');

INSERT INTO aya3_tag VALUES('32','国家','1','12','','金砖国家要共同维护二战胜利成果','1436512409');

INSERT INTO aya3_tag VALUES('33','二战','1','12','','金砖国家要共同维护二战胜利成果','1436512409');

INSERT INTO aya3_tag VALUES('34','金砖','1','13','','金砖国家要共同维护二战胜利成果','1436512415');

INSERT INTO aya3_tag VALUES('35','国家','1','13','','金砖国家要共同维护二战胜利成果','1436512415');

INSERT INTO aya3_tag VALUES('36','二战','1','13','','金砖国家要共同维护二战胜利成果','1436512415');

INSERT INTO aya3_tag VALUES('37','金砖','1','14','','金砖国家要共同维护二战胜利成果','1436512426');

INSERT INTO aya3_tag VALUES('38','国家','1','14','','金砖国家要共同维护二战胜利成果','1436512426');

INSERT INTO aya3_tag VALUES('39','二战','1','14','','金砖国家要共同维护二战胜利成果','1436512426');

INSERT INTO aya3_tag VALUES('40','金砖','1','15','','金砖国家要共同维护二战胜利成果','1436512447');

INSERT INTO aya3_tag VALUES('41','国家','1','15','','金砖国家要共同维护二战胜利成果','1436512447');

INSERT INTO aya3_tag VALUES('42','二战','1','15','','金砖国家要共同维护二战胜利成果','1436512447');

INSERT INTO aya3_tag VALUES('43','诗婷','2','2','','诗婷露雅玫瑰果美白护肤品套装补水淡斑淡化痘印黄气提亮肤色乳液','1436517128');

INSERT INTO aya3_tag VALUES('44','露雅','2','2','','诗婷露雅玫瑰果美白护肤品套装补水淡斑淡化痘印黄气提亮肤色乳液','1436517128');

INSERT INTO aya3_tag VALUES('45','坚果','2','2','','诗婷露雅玫瑰果美白护肤品套装补水淡斑淡化痘印黄气提亮肤色乳液','1436517128');

DROP TABLE IF EXISTS `aya3_text`;

CREATE TABLE `aya3_text` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO aya3_text VALUES('1','','<p style=\"text-indent: 2em;\">Ayacms是我见过最优秀的建站工具,其可视的编辑环境,极大的方便了初学者.通过简单的拖拽,短短几分钟就能创建一个漂亮的网站.</p><p style=\"text-align: right;\">孙小姐(大连)</p>','1437364585','页尾 用户反馈2','1507/20/14373647211639.jpg','http://');

INSERT INTO aya3_text VALUES('2','','<p style=\"text-indent: 2em;\">Aya源码严谨,可视化编辑生成的html代码居然没有冗余,这与网络其它的可视建站程序更显得独树一帜.框架严谨,二次开发也非常方便.</p><p style=\"text-align: right;\"><span style=\"text-align: right;\">李先生(大连)</span></p>','1437365223','页尾 用户反馈','1507/20/14373649107081.jpg','http://');

DROP TABLE IF EXISTS `aya3_video`;

CREATE TABLE `aya3_video` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `posttime` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `aya3_video_5`;

CREATE TABLE `aya3_video_5` (
  `itemid` int(10) NOT NULL AUTO_INCREMENT,
  `author` varchar(20) NOT NULL DEFAULT '',
  `posttime` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `keyword` varchar(100) NOT NULL,
  `cs` varchar(250) NOT NULL DEFAULT '',
  `thumb` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `note` char(255) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `tag` varchar(100) NOT NULL,
  `color` varchar(12) NOT NULL,
  `original` tinyint(1) NOT NULL DEFAULT '0',
  `vurl` varchar(250) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `hits` (`hits`),
  KEY `sign` (`sign`),
  KEY `posttime` (`posttime`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO aya3_video_5 VALUES('1','admin','1437021694','<p>我今年6岁了，跟大家一起分享我的快乐。视频中的模组和地图,请至www.ayacms.com获取.</p>','MC我的世界-彩芸娱乐','95','','','1507/16/14370231554105.jpg','','我的世界,1.7.2 彩芸娱乐','','0','','','0','http://player.youku.com/player.php/sid/XMTI4MzAyNjAwMA==/v.swf');

