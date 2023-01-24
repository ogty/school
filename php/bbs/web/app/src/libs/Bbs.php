<?php
require_once(__DIR__ . '/Db.php');

class Bbs {

    public const NUMBER_OF_DISPLAYS = 10;

    public static function getList($page = 1) {
        $sql = 'SELECT * FROM bbses ORDER BY bbs_id DESC LIMIT :offset, :limit';
        $stmt = Db::getHandle() -> prepare($sql);
        $stmt -> bindValue(':offset', ($page - 1) * self::NUMBER_OF_DISPLAYS, PDO::PARAM_INT);
        $stmt -> bindValue(':limit', self::NUMBER_OF_DISPLAYS + 1, PDO::PARAM_INT);
        $stmt -> execute();
        $bbses = $stmt -> fetchAll();
        $stmt -> closeCursor();

        foreach ($bbses as $k => $v) {
            $sql = 'SELECT * FROM online_comments WHERE bbs_id = :bbs_id ORDER BY online_comment_id DESC';
            $stmt = Db::getHandle() -> prepare($sql);
            $stmt -> bindValue(':bbs_id', $v['bbs_id'], PDO::PARAM_INT);
            $stmt -> execute();
            $responses = $stmt -> fetchAll();
            foreach ($responses as $k2 => $v2) {
                $responses[$k2]['created_at'] = date('Y/m/d H:i:s', strtotime($v2['created_at']));
            }
            $bbses[$k]['responses'] = $responses;
            $stmt -> closeCursor();
        }

        return $bbses;
    }

    public static function find($bbs_id) {
        $sql = 'SELECT * FROM bbses WHERE bbs_id = :bbs_id';
        $stmt = Db::getHandle() -> prepare($sql);
        $stmt -> bindValue(':bbs_id', $bbs_id, PDO::PARAM_INT);
        $stmt -> execute();
        $comment = $stmt -> fetch();
        $stmt -> closeCursor();
        return $comment;
    }

    public static function delete($bbs_id) {
        $sql = 'DELETE FROM bbses WHERE bbs_id = :bbs_id';
        $stmt = Db::getHandle() -> prepare($sql);
        $stmt -> bindValue(':bbs_id', $bbs_id, PDO::PARAM_INT);
        $stmt -> execute();
        $stmt -> closeCursor();
    }
}
