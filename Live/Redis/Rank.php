<?php
/**
 * Created by PhpStorm.
 * User: sunzhenghua
 * Date: 16/7/29
 * Time: 下午3:09
 */

namespace Live\Redis;


class Rank extends Common
{
    public $cfg_key = 'redis_1';

    public $key_rank_send = 'rank_send';
    public $key_rank_income = 'rank_income';

    public $key_rank_room = 'rank_room:';

    public function addRank($send_uid, $to_uid, $n)
    {
        //房间土豪榜
        $this->link->zIncrBy($this->key_rank_room . $to_uid, $n, $send_uid);
        //土豪总榜
        $this->link->zIncrBy($this->key_rank_send, $n, $send_uid);
        //收礼总榜
        $this->link->zIncrBy($this->key_rank_income, $n, $to_uid);
    }

    public function getRankInRoom($uid, $start)
    {
        return $this->_getRank($this->key_rank_room . $uid, $start);
    }

    public function getRankOfSend($start)
    {
        return $this->_getRank($this->key_rank_send, $start);
    }

    public function getRankOfIncome($start)
    {
        return $this->_getRank($this->key_rank_income, $start);
    }

    private function _getRank($key, $start)
    {
        $data = parent::revRange($key, $start, 20, true);

        $ret = array();
        $db_user = new \Live\Database\User();
        foreach ($data as $uid => $money) {
            $ret[] = [
                'user' => $db_user->getShowInfo($uid, 'simple'),
                'money' => $money,
            ];
        }

        return $ret;
    }
}