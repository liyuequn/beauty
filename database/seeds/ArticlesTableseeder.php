<?php

use Illuminate\Database\Seeder;

class ArticlesTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        //
//        \Illuminate\Support\Facades\DB::insert("
//            INSERT INTO `articles` VALUES (1, 1, '因为爱情', '所以没有悲伤。', 2, '2017-11-29 22:13:01', NULL, 0, 0, 0, NULL, '2017-11-29 22:13:38', '2017-11-29 22:13:38');
//INSERT INTO `articles` VALUES (2, 1, '李白', '李白斗酒诗百篇。', 2, '2017-11-29 22:36:40', NULL, 0, 0, 0, NULL, '2017-11-29 22:37:09', '2017-11-29 22:37:09');
//INSERT INTO `articles` VALUES (3, 1, '暗涌', '其实我在去抱紧你又有何用，难道这次我抱紧你未必落空。', 2, '2017-11-29 22:37:40', NULL, 0, 0, 0, NULL, '2017-11-29 22:38:26', '2017-11-29 22:38:26');
//INSERT INTO `articles` VALUES (4, 1, '暗涌', '其实我在去抱紧你又有何用，难道这次我抱紧你未必落空。', 2, '2017-11-29 22:37:40', NULL, 0, 0, 0, '2017-11-30 15:27:30', '2017-11-29 22:38:28', '2017-11-30 15:27:30');
//INSERT INTO `articles` VALUES (5, 1, '人来人往', '最美长发未留在我手，我也曾开心饮过酒。', 2, '2017-11-29 22:38:57', NULL, 0, 0, 0, NULL, '2017-11-29 22:39:25', '2017-11-29 22:39:25');
//INSERT INTO `articles` VALUES (6, 1, '人来人往', '最美长发未留在我手，我也曾开心饮过酒。', 2, '2017-11-29 22:38:57', NULL, 0, 0, 0, NULL, '2017-11-29 22:39:31', '2017-11-29 22:39:31');
//INSERT INTO `articles` VALUES (7, 1, '钟无艳', '没有得你的允许，我都会爱下去。', 2, '2017-11-29 22:44:54', NULL, 0, 0, 0, NULL, '2017-11-29 22:45:14', '2017-11-29 22:45:14');
//INSERT INTO `articles` VALUES (8, 1, '钟无艳', '没有得你的允许，我都会爱下去。', 2, '2017-11-29 22:44:54', NULL, 0, 0, 0, NULL, '2017-11-29 22:45:24', '2017-11-29 22:45:24');
//INSERT INTO `articles` VALUES (9, 1, '想把我唱给你听', '趁现在年少如花。', 2, '2017-11-29 22:47:18', NULL, 0, 0, 0, NULL, '2017-11-29 22:49:46', '2017-11-29 22:49:46');
//INSERT INTO `articles` VALUES (10, 1, '想把我唱给你听', '趁现在年少如花。', 2, '2017-11-29 22:47:18', NULL, 0, 0, 0, NULL, '2017-11-29 22:50:08', '2017-11-29 22:50:08');
//INSERT INTO `articles` VALUES (11, 1, '想把我唱给你听', '趁现在年少如花。', 2, '2017-11-29 22:47:18', NULL, 0, 0, 0, NULL, '2017-11-29 22:50:19', '2017-11-29 22:50:19');
//INSERT INTO `articles` VALUES (12, 1, '路途', '路途遥远，我们在一起吧。', 2, '2017-11-29 22:53:49', NULL, 0, 0, 0, NULL, '2017-11-29 22:54:52', '2017-11-29 22:54:52');
//INSERT INTO `articles` VALUES (13, 1, '路途', '路途遥远，我们在一起吧。', 2, '2017-11-29 22:53:49', NULL, 0, 0, 0, NULL, '2017-11-29 22:55:00', '2017-11-29 22:55:00');
//INSERT INTO `articles` VALUES (14, 1, '花儿', '想把我唱给你听\n趁现在年少如花\n花儿尽情地开吧', 2, '2017-11-29 22:57:08', NULL, 0, 0, 0, NULL, '2017-11-29 22:57:48', '2017-11-29 22:57:48');
//INSERT INTO `articles` VALUES (15, 1, '花儿', '想把我唱给你听\n趁现在年少如花\n花儿尽情地开吧', 2, '2017-11-29 22:57:08', NULL, 0, 0, 0, NULL, '2017-11-29 22:57:59', '2017-11-29 22:57:59');
//INSERT INTO `articles` VALUES (16, 1, '花儿', '想把我唱给你听\n趁现在年少如花\n花儿尽情地开吧', 2, '2017-11-29 22:57:08', NULL, 0, 0, 0, NULL, '2017-11-29 22:58:23', '2017-11-29 22:58:23');
//INSERT INTO `articles` VALUES (17, 1, '花儿', '想把我唱给你听\n趁现在年少如花\n花儿尽情地开吧', 2, '2017-11-29 22:57:08', NULL, 0, 0, 0, NULL, '2017-11-29 22:58:29', '2017-11-29 22:58:29');
//INSERT INTO `articles` VALUES (18, 1, '测试', 'this is  a test.', 1, '2017-11-29 23:11:51', NULL, 0, 0, 0, NULL, '2017-11-29 23:12:07', '2017-11-29 23:12:07');
//INSERT INTO `articles` VALUES (19, 1, 'test', 'this is the second test. try me birch.', 1, '2017-11-29 23:12:28', NULL, 0, 0, 0, NULL, '2017-11-29 23:12:46', '2017-11-29 23:12:46');
//INSERT INTO `articles` VALUES (20, 12, '突然心动', '# 一级标题\n## 二级标题  \n### 三级标题  \n好久都没有写博客了，这是第一次在自己做的博客里写博客。  \n### 图片  \n![](https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1512039380910&di=73cc563192f7b5ae484c86998fe81425&imgtype=0&src=http%3A%2F%2Fa.hiphotos.baidu.com%2Fimage%2Fpic%2Fitem%2F0823dd54564e9258f18fc9049682d158cdbf4ea4.jpg)', 2, '2017-11-30 15:28:05', NULL, 0, 0, 0, NULL, '2017-11-30 15:35:58', '2017-11-30 15:35:58');
//INSERT INTO `articles` VALUES (21, 12, 'linux node.js的安装', '1.首先官网下载自己想安装的版本（此处安装为编译后的包），此处为此时最新版本，下载到了root目录\n\n`articles``\nwget https://nodejs.org/download/chakracore-release/v8.6.0/node-v8.6.0-linux-x64.tar.gz\n`articles``\n2.解压包\n\n`articles``\ntar -zxf node-v8.6.0-linux-x64.tar.gz\n`articles``\n3.进入解压后的包，测试是否管用,如果出现版本，说明管用。\n\n`articles``\ncd node-v8.6.0-linux-x64/bin/\n./node -v\n`articles``\n4.建立软链接，实现全局访问\n\n`articles``\nln -s /root/node-v8.6.0-linux-x64/bin/node /usr/local/bin/node\nln -s /root/node-v8.6.0-linux-x64/bin/npm /usr/local/bin/npm\n`articles``\n5.安装淘宝镜像cnpm\n\n`articles``\nnpm install -g cnpm --registry=https://registry.npm.taobao.org\n\n`articles``\n6.以后使用npm就可以替换成cnpm了\n\n`articles``\nln -s /root/node-v8.6.0-linux-x64/bin/cnpm /usr/local/bin/cnpm\ncnpm -v\n`articles``', 1, '2017-11-30 15:41:56', NULL, 0, 0, 0, NULL, '2017-11-30 15:43:09', '2017-11-30 15:43:09')"
//
//        );

    }
}
