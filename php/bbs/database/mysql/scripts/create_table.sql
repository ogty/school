USE bbs;

CREATE TABLE bbses
  (
     bbs_id          SERIAL,
     name            VARCHAR(128) NOT NULL comment '投稿者名',
     title           VARCHAR(128) NOT NULL comment 'タイトル',
     body            TEXT comment '本文',
     --
     user_agent      TEXT comment 'ブラウザ名',
     from_ip         VARBINARY(128) NOT NULL comment '接続元IP',
     --
     created_at      DATETIME NOT NULL comment '書き込み日時',
     delete_password VARCHAR(128) NOT NULL comment '削除パスワード',
     -- updated_at DATETIME NOT NULL COMMENT '',
     --
     PRIMARY KEY(bbs_id)
  ) CHARACTER SET 'utf8mb4', comment='掲示板テーブル';

CREATE TABLE online_comments
  (
     online_comment_id SERIAL,
     bbs_id            BIGINT UNSIGNED NOT NULL comment '紐づく掲示板id',
     comment_body      TEXT comment 'コメント本文',
     --
     user_agent        TEXT comment 'ブラウザ名',
     from_ip           VARBINARY(128) NOT NULL comment '接続元IP',
     --
     created_at        DATETIME NOT NULL comment '',
     -- updated_at DATETIME NOT NUMM COMMENT '',
     -- 外部キー制約
     CONSTRAINT fk_comments_bbs_id FOREIGN KEY (bbs_id) REFERENCES bbses (bbs_id
     ) ON DELETE CASCADE,
     --
     PRIMARY KEY(online_comment_id)
  ) CHARACTER SET 'utf8mb4', comment='掲示板のコメントテーブル';
