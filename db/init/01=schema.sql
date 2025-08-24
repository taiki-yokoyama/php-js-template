-- DB とユーザーは docker-compose の環境変数で作成済み
-- ここではアプリ用テーブルを作成・初期投入

CREATE TABLE IF NOT EXISTS samples (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO samples (name) VALUES
('初期データ 1'),
('初期データ 2');
