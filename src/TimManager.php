<?php

namespace luoyy\Tim;

use luoyy\Tim\Support\MsgBody;
use luoyy\Tim\Support\OfflinePushInfo;
use luoyy\Tim\Support\UserAttrs;
use luoyy\Tim\Support\UserTags;

/**
 * TimManager.
 */
class TimManager extends Tim
{
    /**
     * ============
     * 账号管理开始
     * ============.
     */

    /**
     * 账户管理 im_open_login_svc.
     */

    /**
     * 单个帐号导入接口.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1608
     * @param string $identifier 用户名，长度不超过32字节
     * @param string|null $nick 用户昵称
     * @param string|null $face_url 用户头像 URL
     * @return mixed 返回值
     */
    public function account_import(string $identifier, ?string $nick = null, ?string $face_url = null)
    {
        return $this->api('im_open_login_svc', __FUNCTION__, [
            'Identifier' => $identifier,
            'Nick' => $nick,
            'FaceUrl' => $face_url,
        ]);
    }

    /**
     * 批量帐号导入接口.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/4919
     * @return mixed 返回值
     */
    public function multiaccount_import(string ...$accounts)
    {
        return $this->api('im_open_login_svc', __FUNCTION__, [
            'Accounts' => $accounts,
        ]);
    }

    /**
     * 帐号删除接口.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/36443
     * @return mixed 返回值
     */
    public function account_delete(string ...$user_ids)
    {
        return $this->api('im_open_login_svc', __FUNCTION__, [
            'DeleteItem' => array_map(function ($id) {
                return ['UserID' => $id];
            }, $user_ids),
        ]);
    }

    /**
     * 帐号检查接口.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/38417
     * @return mixed 返回值
     */
    public function account_check(string ...$user_ids)
    {
        return $this->api('im_open_login_svc', __FUNCTION__, [
            'CheckItem' => array_map(function ($id) {
                return ['UserID' => $id];
            }, $user_ids),
        ]);
    }

    /**
     * 帐号登录态失效接口.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/3853
     * @param string $user_id 用户名
     * @return mixed 返回值
     */
    public function kick(string $user_id)
    {
        return $this->api('im_open_login_svc', __FUNCTION__, [
            'UserID' => $user_id,
        ]);
    }

    /**
     * 在线状态 openim.
     */

    /**
     * 获取用户在线状态
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/2566
     * @param array<int, string> $accounts 需要查询这些 Identifier 的登录状态，一次最多查询500个 Identifier 的状态
     * @param int|null $is_need_detail 是否需要返回详细的登录平台信息。0表示不需要，1表示需要
     * @return mixed 返回值
     * @deprecated 2021-09-08 14:54:11
     */
    public function querystate(array $accounts, ?int $is_need_detail = null)
    {
        return $this->query_online_status($accounts, $is_need_detail);
    }

    /**
     * 获取用户在线状态
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/2566
     * @param array<int, string> $accounts 需要查询这些 Identifier 的登录状态，一次最多查询500个 Identifier 的状态
     * @param int|null $is_need_detail 是否需要返回详细的登录平台信息。0表示不需要，1表示需要
     * @return mixed 返回值
     */
    public function query_online_status(array $accounts, ?int $is_need_detail = null)
    {
        return $this->api('openim', __FUNCTION__, [
            'IsNeedDetail' => $is_need_detail,
            'To_Account' => array_map('strval', $accounts),
        ]);
    }

    /**
     * ============
     * 账号管理结束
     * ============.
     */

    /**
     * ============
     * 单聊消息开始
     * ============.
     */

    /**
     * 单聊消息 openim.
     */

    /**
     * 单发单聊消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/2282
     * @param string $to_account 消息接收方 UserID
     * @param \luoyy\Tim\Support\MsgBody $msg_body 消息内容，具体格式请参考 消息格式描述（注意，一条消息可包括多种消息元素，MsgBody 为 Array 类型）
     * @param string|null $from_account 消息发送方 UserID（用于指定发送消息方帐号）
     * @param \luoyy\Tim\Support\OfflinePushInfo|null $offline_push_info 离线推送信息配置，具体可参考 消息格式描述
     * @param int|null $sync_other_machine 1：把消息同步到 From_Account 在线终端和漫游上； 2：消息不同步至 From_Account； 若不填写默认情况下会将消息存 From_Account 漫游
     * @param int|null $msg_life_time 消息离线保存时长（单位：秒），最长为7天（604800秒） 若设置该字段为0，则消息只发在线用户，不保存离线 若设置该字段超过7天（604800秒），仍只保存7天 若不设置该字段，则默认保存7天
     * @param array<int, string>|null $forbid_callback_control 消息回调禁止开关，只对本条消息有效，ForbidBeforeSendMsgCallback 表示禁止发消息前回调，ForbidAfterSendMsgCallback 表示禁止发消息后回调
     * @param array<int, string>|null $send_msg_control 消息发送控制选项，是一个 String 数组，只对本条消息有效。"NoUnread"表示该条消息不计入未读数。"NoLastMsg"表示该条消息不更新会话列表。"WithMuteNotifications"表示该条消息的接收方对发送方设置的免打扰选项生效（默认不生效）。示例："SendMsgControl": ["NoUnread","NoLastMsg","WithMuteNotifications"]
     * @param string|null $cloud_custom_data 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     * @return mixed 返回值
     */
    public function sendmsg(string $to_account, MsgBody $msg_body, ?string $from_account = null, ?OfflinePushInfo $offline_push_info = null, ?int $sync_other_machine = null, ?int $msg_life_time = null, ?array $forbid_callback_control = null, ?array $send_msg_control = null, ?string $cloud_custom_data = null)
    {
        return $this->api('openim', __FUNCTION__, [
            'SyncOtherMachine' => $sync_other_machine,
            'From_Account' => $from_account,
            'To_Account' => $to_account,
            'MsgLifeTime' => $msg_life_time,
            // 'MsgSeq' => ((int) (microtime(true) * 1000)) % 0xFFFFFFFF,
            'MsgRandom' => $this->getMsgRandom(), // 消息随机数，由随机函数产生，用于后台定位问题
            // 'MsgTimeStamp' => time(), // 消息时间戳，UNIX 时间戳（单位：秒）
            'ForbidCallbackControl' => $forbid_callback_control,
            'SendMsgControl' => $send_msg_control,
            'MsgBody' => $msg_body->toArray(),
            'CloudCustomData' => $cloud_custom_data,
            'OfflinePushInfo' => !is_null($offline_push_info) ? $offline_push_info->toArray() : $offline_push_info,
        ]);
    }

    /**
     * 批量发单聊消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1612
     * @param array $accounts 消息接收方 Identifier
     * @param \luoyy\Tim\Support\MsgBody $msg_body TIM 消息
     * @param string|null $from_account 消息发送方 Identifier，用于指定发送消息方
     * @param \luoyy\Tim\Support\OfflinePushInfo|null $offline_push_info 离线推送信息配置
     * @param int|null $sync_other_machine 1：把消息同步到 From_Account 在线终端和漫游上 2：消息不同步至 From_Account；若不填写默认情况下会将消息存 From_Account 漫游
     * @param int|null $msg_life_time 消息离线保存时长（单位：秒），最长为7天（604800秒） 若设置该字段为0，则消息只发在线用户，不保存离线 若设置该字段超过7天（604800秒），仍只保存7天 若不设置该字段，则默认保存7天
     * @param string|null $cloud_custom_data 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     * @param array<int, string>|null $send_msg_control 消息发送控制选项，是一个 String 数组，只对本条消息有效。"NoUnread"表示该条消息不计入未读数。"NoLastMsg"表示该条消息不更新会话列表。"WithMuteNotifications"表示该条消息的接收方对发送方设置的免打扰选项生效（默认不生效）。示例："SendMsgControl": ["NoUnread","NoLastMsg","WithMuteNotifications"]*
     * @return mixed 返回值
     */
    public function batchsendmsg(array $accounts, MsgBody $msg_body, ?string $from_account = null, ?OfflinePushInfo $offline_push_info = null, ?int $sync_other_machine = null, ?int $msg_life_time = null, ?array $send_msg_control = null, ?string $cloud_custom_data = null)
    {
        return $this->api('openim', __FUNCTION__, [
            'SyncOtherMachine' => $sync_other_machine,
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            // 'MsgSeq' => ((int) (microtime(true) * 1000)) % 0xFFFFFFFF,
            'MsgRandom' => $this->getMsgRandom(),
            'MsgBody' => $msg_body->toArray(),
            'MsgLifeTime' => $msg_life_time,
            'CloudCustomData' => $cloud_custom_data,
            'SendMsgControl' => $send_msg_control,
            'OfflinePushInfo' => !is_null($offline_push_info) ? $offline_push_info->toArray() : $offline_push_info,
        ]);
    }

    /**
     * 导入单聊消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/2568
     * @param string $from_account 消息发送方 Identifier，用于指定发送消息方
     * @param string $to_account 消息接收方 Identifier
     * @param \luoyy\Tim\Support\MsgBody $msg_body 消息内容
     * @param int $sync_from_old_system 该字段只能填1或2，其他值是非法值 1表示实时消息导入，消息加入未读计数 2表示历史消息导入，消息不计入未读
     * @param string|null $cloud_custom_data 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     * @return mixed 返回值
     */
    public function importmsg(string $from_account, string $to_account, MsgBody $msg_body, int $sync_from_old_system = 2, ?string $cloud_custom_data = null)
    {
        return $this->api('openim', __FUNCTION__, [
            'SyncFromOldSystem' => $sync_from_old_system,
            'From_Account' => $from_account,
            'To_Account' => $to_account,
            // 'MsgSeq' => ((int) (microtime(true) * 1000)) % 0xFFFFFFFF,
            'MsgRandom' => $this->getMsgRandom(),
            'MsgTimeStamp' => time(),
            'MsgBody' => $msg_body->toArray(),
            'CloudCustomData' => $cloud_custom_data,
        ]);
    }

    /**
     * 查询单聊消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/42794
     * @param string $operator_account 会话其中一方的 UserID，若已指定发送消息方帐号，则为消息发送方
     * @param string $peer_account 会话其中一方的 UserID
     * @param int $max_cnt 请求的消息条数
     * @param int $min_time 请求的消息时间范围的最小值
     * @param int $max_time 请求的消息时间范围的最大值
     * @param string|null $last_msg_key 上一次拉取到的最后一条消息的 MsgKey，续拉时需要填该字段，填写方法见上方 示例
     * @return mixed 返回值
     */
    public function admin_getroammsg(string $operator_account, string $peer_account, int $max_cnt, int $min_time, int $max_time, ?string $last_msg_key = null)
    {
        return $this->api('openim', __FUNCTION__, [
            'Operator_Account' => $operator_account,
            'Peer_Account' => $peer_account,
            'MaxCnt' => $max_cnt,
            'MinTime' => $min_time,
            'MaxTime' => $max_time,
            'LastMsgKey' => $last_msg_key,
        ]);
    }

    /**
     * 撤回单聊消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/38980
     * @param string $from_account 消息发送方 UserID
     * @param string $to_account 消息接收方 UserID
     * @param string $msg_key 待撤回消息的唯一标识。该字段由 REST API 接口 单发单聊消息 和 批量发单聊消息 返回
     * @return mixed 返回值
     */
    public function admin_msgwithdraw(string $from_account, string $to_account, string $msg_key)
    {
        return $this->api('openim', __FUNCTION__, [
            'From_Account' => $from_account,
            'To_Account' => $to_account,
            'MsgKey' => $msg_key,
        ]);
    }

    /**
     * 设置单聊消息已读.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/50349
     * @param string $report_account 进行消息已读的用户 UserId
     * @param string $peer_account 进行消息已读的单聊会话的另一方用户 UserId
     * @param int|null $msg_read_time 时间戳（秒），该时间戳之前的消息全部已读。若不填，则取当前时间戳
     * @return mixed 返回值
     */
    public function admin_set_msg_read(string $report_account, string $peer_account, ?int $msg_read_time = null)
    {
        return $this->api('openim', __FUNCTION__, [
            'Report_Account' => $report_account,
            'Peer_Account' => $peer_account,
            'MsgReadTime' => $msg_read_time,
        ]);
    }

    /**
     * 查询单聊未读消息计数.
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $to_account 待查询的用户 UserId
     * @param array<int, string>|null $peer_account 待查询的单聊会话对端的用户 UserId。 若要查询单个会话的未读数，该字段必填 该数组最大大小为10
     * @return mixed 返回值
     */
    public function get_c2c_unread_msg_num(string $to_account, ?array $peer_account = null)
    {
        return $this->api('openim', __FUNCTION__, [
            'To_Account' => $to_account,
            'Peer_Account' => array_map('strval', $peer_account),
        ]);
    }

    /**
     * ============
     * 单聊消息结束
     * ============.
     */

    /**
     * ============
     * 全员推送开始
     * ============.
     */

    /**
     * 全员推送 all_member_push.
     */

    /**
     * 全员推送
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45934
     * @param string|null $from_account 消息推送方帐号
     * @param \luoyy\Tim\Support\MsgBody $msg_body 消息内容，具体格式请参考 MsgBody 消息内容说明（一条消息可包括多种消息元素，所以 MsgBody 为 Array 类型）
     * @param int|null $msg_life_time 消息离线存储时间，单位秒，最多保存7天（604800秒）。默认为0，表示不离线存储
     * @param array<string, array>|null $condition Condition 共有4种条件类型，分别是： 属性的或条件 AttrsOr 属性的与条件 AttrsAnd 标签的或条件 TagsOr 标签的与条件 TagsAnd AttrsOr 和 AttrsAnd 可以并存，TagsOr 和 TagsAnd 也可以并存。但是标签和属性条件不能并存。如果没有 Condition，则推送给全部用户
     * @return mixed 返回值
     */
    public function im_push(?string $from_account, MsgBody $msg_body, ?int $msg_life_time = null, ?array $condition = null)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'Condition' => $condition,
            'MsgRandom' => $this->getMsgRandom(), // 消息随机数，由随机函数产生。用于推送任务去重。对于不同的推送请求，MsgRandom7 天之内不能重复，否则视为相同的推送任务（调用推送 API 返回失败的时候可以用相同的 MsgRandom 进行重试）
            'MsgBody' => $msg_body->toArray(),
            'MsgLifeTime' => $msg_life_time,
            'From_Account' => $from_account,
        ]);
    }

    /**
     * 设置应用属性名称.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45935
     * @param array<string, string> $attr_names key-value key:数字键 string类型 表示第几个属性（“0”到“9”之间）,value:属性名 string类型 属性名最长不超过50字节。应用最多可以有10个推送属性（编号从0到9），用户自定义每个属性的含义
     * @return mixed 返回值
     */
    public function im_set_attr_name(array $attr_names)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'AttrNames' => $attr_names,
        ]);
    }

    /**
     * 获取应用属性名称.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45936
     * @return mixed 返回值
     */
    public function im_get_attr_name()
    {
        return $this->api('all_member_push', __FUNCTION__, []);
    }

    /**
     * 获取用户属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45937
     * @return mixed 返回值
     */
    public function im_get_attr(string ...$accounts)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'To_Account' => $accounts,
        ]);
    }

    /**
     * 设置用户属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45938
     * @param \luoyy\Tim\Support\UserAttrs $user_attrs 目标用户帐号, 属性集合。每个属性是一个键值对，键为属性名，值为该用户对应的属性值。用户属性值不能超过50字节
     * @return mixed 返回值
     */
    public function im_set_attr(UserAttrs ...$user_attrs)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'UserAttrs' => array_map(function (UserAttrs $user_attr) {
                return $user_attr->toArray();
            }, $user_attrs),
        ]);
    }

    /**
     * 删除用户属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45939
     * @param \luoyy\Tim\Support\UserAttrs $user_attrs 目标用户帐号, 属性集合，注意这里只需要给出属性名即可；Attrs 形式及含义参见 设置应用属性名称
     * @return mixed 返回值
     */
    public function im_remove_attr(UserAttrs ...$user_attrs)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'UserAttrs' => array_map(function (UserAttrs $user_attr) {
                return $user_attr->toArray();
            }, $user_attrs),
        ]);
    }

    /**
     * 获取用户属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45940
     * @return mixed 返回值
     */
    public function im_get_tag(string ...$accounts)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'To_Account' => $accounts,
        ]);
    }

    /**
     * 添加用户标签.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45941
     * @param \luoyy\Tim\Support\UserTags $user_tags 目标用户帐号, 标签集合
     * @return mixed 返回值
     */
    public function im_add_tag(UserTags ...$user_tags)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'UserTags' => array_map(function (UserTags $user_tag) {
                return $user_tag->toArray();
            }, $user_tags),
        ]);
    }

    /**
     * 删除用户标签.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45942
     * @param \luoyy\Tim\Support\UserTags $user_tags 目标用户帐号, 标签集合
     * @return mixed 返回值
     */
    public function im_remove_tag(UserTags ...$user_tags)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'UserTags' => array_map(function (UserTags $user_tag) {
                return $user_tag->toArray();
            }, $user_tags),
        ]);
    }

    /**
     * 删除用户所有标签.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45943
     * @return mixed 返回值
     */
    public function im_remove_all_tags(string ...$accounts)
    {
        return $this->api('all_member_push', __FUNCTION__, [
            'To_Account' => $accounts,
        ]);
    }

    /**
     * ============
     * 全员推送结束
     * ============.
     */

    /**
     * ============
     * 资料管理开始
     * ============.
     */

    /**
     * 资料管理 profile.
     */

    /**
     * 设置资料.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1640
     * @param string $from_account 需要设置该 UserID 的资料
     * @param array<int, array<string, string>> $profile_item 待设置的用户的资料对象数组，数组中每一个对象都包含了 Tag 和 Value
     * @return mixed 返回值
     */
    public function portrait_set(string $from_account, array $profile_item)
    {
        return $this->api('profile', __FUNCTION__, [
            'From_Account' => $from_account,
            'ProfileItem' => $profile_item,
        ]);
    }

    /**
     * 拉取资料.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1639
     * @param array<int, string> $accounts 需要拉取这些 UserID 的资料； 注意：每次拉取的用户数不得超过100，避免因回包数据量太大以致回包失败
     * @param array<int, string> $tag_list 指定要拉取的资料字段的 Tag，支持的字段有： 1. 标配资料字段，详情可参见 标配资料字段 2. 自定义资料字段，详情可参见 自定义资料字段
     * @return mixed 返回值
     */
    public function portrait_get(array $accounts, array $tag_list)
    {
        return $this->api('profile', __FUNCTION__, [
            'To_Account' => array_map('strval', $accounts),
            'TagList' => $tag_list,
        ]);
    }

    /**
     * ============
     * 资料管理结束
     * ============.
     */

    /**
     * ==============
     * 关系链管理开始
     * ==============.
     */

    /**
     * 关系链管理 sns.
     */

    /**
     * 添加好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1643
     * @param string $from_account 需要为该 UserID 添加好友
     * @param array<int, array<string, string>> $add_friend_item 好友结构体对象
     * @param string $add_type 加好友方式（默认双向加好友方式）： Add_Type_Single 表示单向加好友 Add_Type_Both 表示双向加好友
     * @param int $force_add_flags 管理员强制加好友标记：1表示强制加好友，0表示常规加好友方式
     * @return mixed 返回值
     */
    public function friend_add(string $from_account, array $add_friend_item, ?string $add_type = null, ?int $force_add_flags = null)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'AddFriendItem' => $add_friend_item,
            'AddType' => $add_type,
            'ForceAddFlags' => $force_add_flags,
        ]);
    }

    /**
     * 导入好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/8301
     * @param string $from_account 需要为该 UserID 添加好友
     * @param array<int, array> $add_friend_item 好友结构体对象
     * @return mixed 返回值
     */
    public function friend_import(string $from_account, array $add_friend_item)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'AddFriendItem' => $add_friend_item,
        ]);
    }

    /**
     * 更新好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/12525
     * @param string $from_account 需要更新该 UserID 的关系链数据
     * @param array<int, array> $update_item 需要更新的好友对象数组
     * @return mixed 返回值
     */
    public function friend_update(string $from_account, array $update_item)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'UpdateItem' => $update_item,
        ]);
    }

    /**
     * 删除好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1644
     * @param string $from_account 需要删除该 UserID 的好友
     * @param array<int, string> $accounts 待删除的好友的 UserID 列表，单次请求的 To_Account 数不得超过1000
     * @param string|null $deletet_type 删除模式
     * @return mixed 返回值
     */
    public function friend_delete(string $from_account, array $accounts, ?string $deletet_type = null)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'DeleteType' => $deletet_type,
        ]);
    }

    /**
     * 删除所有好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1645
     * @param string $from_account 指定要清除好友数据的用户的 UserID
     * @param string|null $deletet_type 删除模式，默认删除单向好友
     * @return mixed 返回值
     */
    public function friend_delete_all(string $from_account, ?string $deletet_type = null)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'DeleteType' => $deletet_type,
        ]);
    }

    /**
     * 校验好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1646
     * @param string $from_account 需要校验该 UserID 的好友
     * @param array<int, string> $accounts 请求校验的好友的 UserID 列表，单次请求的 To_Account 数不得超过1000
     * @param string $check_type 校验模式
     * @return mixed 返回值
     */
    public function friend_check(string $from_account, array $accounts, string $check_type)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'CheckType' => $check_type,
        ]);
    }

    /**
     * 拉取好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1647
     * @param string $from_account 指定要拉取好友数据的用户的 UserID
     * @param int $start_index 分页的起始位置
     * @param int|null $standard_sequence 上次拉好友数据时返回的 StandardSequence，如果 StandardSequence 字段的值与后台一致，后台不会返回标配好友数据
     * @param int|null $custom_sequence 上次拉好友数据时返回的 CustomSequence，如果 CustomSequence 字段的值与后台一致，后台不会返回自定义好友数据
     * @return mixed 返回值
     */
    public function friend_get(string $from_account, int $start_index = 0, ?int $standard_sequence = null, ?int $custom_sequence = null)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'StartIndex' => $start_index,
            'StandardSequence' => $standard_sequence,
            'CustomSequence' => $custom_sequence,
        ]);
    }

    /**
     * 拉取指定好友.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/8609
     * @param string $from_account 指定要拉取好友数据的用户的 UserID
     * @param array<int, string> $accounts 好友的 UserID 列表 建议每次请求的好友数不超过100，避免因数据量太大导致回包失败
     * @param array<int, string> $tag_list 指定要拉取的资料字段及好友字段
     * @return mixed 返回值
     */
    public function friend_get_list(string $from_account, array $accounts, array $tag_list)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'TagList' => $tag_list,
        ]);
    }

    /**
     * 添加黑名单.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/3718
     * @param string $from_account 请求为该 UserID 添加黑名单
     * @param array<int, string> $accounts 待添加为黑名单的用户 UserID 列表，单次请求的 To_Account 数不得超过1000
     * @return mixed 返回值
     */
    public function black_list_add(string $from_account, array $accounts)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
        ]);
    }

    /**
     * 删除黑名单.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/3719
     * @param string $from_account 需要删除该 UserID 的黑名单
     * @param array<int, string> $accounts 待添加为黑名单的用户 UserID 列表，单次请求的 To_Account 数不得超过1000
     * @return mixed 返回值
     */
    public function black_list_delete(string $from_account, array $accounts)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
        ]);
    }

    /**
     * 拉取黑名单.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/3722
     * @param string $from_account 需要拉取该 UserID 的黑名单
     * @param int $start_index 拉取的起始位置
     * @param int $max_limited 每页最多拉取的黑名单数
     * @param int $last_sequence 上一次拉黑名单时后台返回给客户端的 Seq，初次拉取时为0
     * @return mixed 返回值
     */
    public function black_list_get(string $from_account, int $start_index = 0, int $max_limited = 30, int $last_sequence = 0)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'StartIndex' => $start_index,
            'MaxLimited' => $max_limited,
            'LastSequence' => $last_sequence,
        ]);
    }

    /**
     * 校验黑名单.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/3725
     * @param string $from_account 需要校验该 UserID 的黑名单
     * @param array<int, string> $accounts 待校验的黑名单的 UserID 列表，单次请求的 To_Account 数不得超过1000
     * @param string $check_type 校验模式
     * @return mixed 返回值
     */
    public function black_list_check(string $from_account, array $accounts, string $check_type)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'CheckType' => $check_type,
        ]);
    }

    /**
     * 添加分组.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/10107
     * @param string $from_account 需要为该 UserID 添加新分组
     * @param array<int, string> $group_name 新增分组列表
     * @param array<int, string>|null $accounts 需要加入新增分组的好友的 UserID 列表
     * @return mixed 返回值
     */
    public function group_add(string $from_account, array $group_name, ?array $accounts = null)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'GroupName' => array_map('strval', $group_name),
            'To_Account' => !is_null($accounts) ? array_map('strval', $accounts) : null,
        ]);
    }

    /**
     * 删除分组.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/10108
     * @param string $from_account 需要删除该 UserID 的分组
     * @param array<int, string> $group_name 要删除的分组列表
     * @return mixed 返回值
     */
    public function group_delete(string $from_account, array $group_name)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'GroupName' => array_map('strval', $group_name),
        ]);
    }

    /**
     * 拉取分组.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/54763
     * @param string $from_account 指定要拉取分组的用户的 UserID
     * @param string|null $need_friend 是否需要拉取分组下的 User 列表, Need_Friend_Type_Yes: 需要拉取, 不填时默认不拉取, 只有 GroupName 为空时有效
     * @param array<int, string> $group_name 要拉取的分组名称
     * @return mixed 返回值
     */
    public function group_get(string $from_account, ?string $need_friend = null, ?array $group_name = null)
    {
        return $this->api('sns', __FUNCTION__, [
            'From_Account' => $from_account,
            'NeedFriend' => $need_friend,
            'GroupName' => !is_null($group_name) ? array_map('strval', $group_name) : null,
        ]);
    }

    /**
     * ==============
     * 关系链管理结束
     * ==============.
     */

    /**
     * 最近联系人开始.
     */

    /**
     * 拉取会话列表.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/62118
     * @param string $from_account 填 UserID，请求拉取该用户的会话列表
     * @param int $time_stamp 普通会话的起始时间，第一页填 0
     * @param int $start_index 普通会话的起始位置，第一页填 0
     * @param int $top_time_stamp 置顶会话的起始时间，第一页填 0
     * @param int $top_start_index 置顶会话的起始位置，第一页填 0
     * @param int $assist_flags 会话辅助标志位: bit 0 - 是否支持置顶会话 bit 1 - 是否返回空会话 bit 2 - 是否支持置顶会话分页
     * @return mixed 返回值
     */
    public function get_list(string $from_account, int $time_stamp, int $start_index, int $top_time_stamp, int $top_start_index, int $assist_flags)
    {
        return $this->api('recentcontact', __FUNCTION__, [
            'From_Account' => $from_account,
            'TimeStamp' => $time_stamp,
            'StartIndex' => $start_index,
            'TopTimeStamp' => $top_time_stamp,
            'TopStartIndex' => $top_start_index,
            'AssistFlags' => $assist_flags,
        ]);
    }

    /**
     * 删除单个会话.
     * @copyright (c) zishang520 All Rights Reserved
     * @param string $from_account 请求删除该 UserID 的会话
     * @param int $type 会话类型：1 表示 C2C 会话；2 表示 G2C 会话
     * @param string|null $to_account C2C 会话才赋值，C2C 会话方的 UserID
     * @param int|null $clearramble 是否清理漫游消息：1 表示清理漫游消息；0 表示不清理漫游消
     * @param string|null $to_groupid G2C 会话才赋值，G2C 会话的群 ID
     * @return mixed 返回值
     */
    public function delete(string $from_account, int $type, ?string $to_account = null, ?int $clearramble = null, ?string $to_groupid = null)
    {
        return $this->api('recentcontact', __FUNCTION__, [
            'From_Account' => $from_account,
            'Type' => $type,
            'To_Account' => $to_account,
            'ToGroupid' => $to_groupid,
            'ClearRamble' => $clearramble,
        ]);
    }

    /**
     * 最近联系人结束.
     */

    /**
     * ============
     * 群组管理开始
     * ============.
     */

    /**
     * 群组管理 group_open_http_svc.
     */

    /**
     * description.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1614
     * @param int|null $limit 本次获取的群组 ID 数量的上限，不得超过 10000。如果不填，默认为最大值 10000
     * @param int|null $next 群太多时分页拉取标志，第一次填0，以后填上一次返回的值，返回的 Next 为0代表拉完了
     * @param string|null $group_type 如果仅需要返回特定群组形态的群组，可以通过 GroupType 进行过滤，但此时返回的 TotalCount 的含义就变成了 App 中属于该群组形态的群组总数。不填为获取所有类型的群组。 群组形态包括 Public（公开群），Private（私密群），ChatRoom（聊天室），AVChatRoom（音视频聊天室）和 BChatRoom（在线成员广播大群）
     * @return mixed 返回值
     */
    public function get_appid_group_list(?int $limit = null, ?int $next = null, ?string $group_type = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'Limit' => $limit,
            'Next' => $next,
            'GroupType' => $group_type,
        ]);
    }

    /**
     * 创建群组.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1615
     * @param string $name 群名称，最长30字节，使用 UIT-8 编码，1个汉字占3个字节
     * @param string $type 群组形态，包括 Public（公开群），Private（私密群），ChatRoom（聊天室），AVChatRoom（音视频聊天室），BChatRoom（在线成员广播大群）
     * @param string|null $owner_account 群主 ID，自动添加到群成员中。如果不填，群没有群主
     * @param string|null $group_id 为了使得群组 ID 更加简单，便于记忆传播，腾讯云支持 App 在通过 REST API 创建群组时 自定义群组 ID
     * @param array|null $member_list 初始群成员列表，最多500个；成员信息字段详情请参阅 群成员资料
     * @param int|null $max_member_count 最大群成员数量，缺省时的默认值：私有群是200，公开群是2000，聊天室是6000，音视频聊天室和在线成员广播大群无限制
     * @param string|null $apply_join_option 申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群），不填默认为 NeedPermission（需要验证） 仅当创建支持申请加群的 群组 时，该字段有效
     * @param string|null $introduction 群简介，最长240字节，使用 UIT-8 编码，1个汉字占3个字节
     * @param string|null $notification 群公告，最长300字节，使用 UIT-8 编码，1个汉字占3个字节
     * @param string|null $face_url 群头像 URL，最长100字节
     * @param array|null $app_defined_data 群组维度的自定义字段，默认情况是没有的，需要开通，详情请参阅 自定义字段
     * @param array|null $app_member_defined_data 群成员维度的自定义字段，默认情况是没有的，需要开通，详情请参阅 自定义字段
     * @return mixed 返回值
     */
    public function create_group(string $name, string $type, ?string $owner_account = null, ?string $group_id = null, ?array $member_list = null, ?int $max_member_count = null, ?string $apply_join_option = null, ?string $introduction = null, ?string $notification = null, ?string $face_url = null, ?array $app_defined_data = null, ?array $app_member_defined_data = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'Owner_Account' => $owner_account,
            'Type' => $type,
            'GroupId' => $group_id,
            'Name' => $name,
            'Introduction' => $introduction,
            'Notification' => $notification,
            'FaceUrl' => $face_url,
            'MaxMemberCount' => $max_member_count,
            'ApplyJoinOption' => $apply_join_option,
            'AppDefinedData' => $app_defined_data,
            'MemberList' => $member_list,
            'AppMemberDefinedData' => $app_member_defined_data,
        ]);
    }

    /**
     * 获取群组详细资料.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1616
     * @param array $group_id_list 需要拉取的群组列表
     * @param array<string, array<int, string>>|null $response_filter 包含三个过滤器：GroupBaseInfoFilter，MemberInfoFilter，AppDefinedDataFilter_Group，分别是基础信息字段过滤器，成员信息字段过滤器，群组维度的自定义字段过滤器
     * @return mixed 返回值
     */
    public function get_group_info(array $group_id_list, ?array $response_filter = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupIdList' => array_map('strval', $group_id_list),
            'ResponseFilter' => $response_filter,
        ]);
    }

    /**
     * 获取群组成员详细资料.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1617
     * @param string $group_id 需要拉取成员信息的群组的 ID
     * @param int|null $limit 一次最多获取多少个成员的资料，不得超过10000。如果不填，则获取群内全部成员的信息
     * @param int|null $offset 从第几个成员开始获取，如果不填则默认为0，表示从第一个成员开始获取
     * @param string|null $next 上一次拉取到的成员位置，社群必填，社群不支持 Offset 参数，使用 Next 参数，首次调用填写""，续拉使用返回中的 Next 值
     * @param array|null $member_info_filter 需要获取哪些信息， 如果没有该字段则为群成员全部资料，成员信息字段详情请参阅 群成员资料
     * @param array|null $member_role_filter 拉取指定身份的群成员资料。如没有填写该字段，默认为所有身份成员资料，成员身份可以为：“Owner”，“Admin”，“Member”
     * @param array|null $app_defined_data_filter_group_member 默认情况是没有的。该字段用来群成员维度的自定义字段过滤器，指定需要获取的群成员维度的自定义字段，群成员维度的自定义字段详情请参阅 自定义字段
     * @return mixed 返回值
     */
    public function get_group_member_info(string $group_id, ?int $limit = null, ?int $offset = null, ?string $next = null, ?array $member_info_filter = null, ?array $member_role_filter = null, ?array $app_defined_data_filter_group_member = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Limit' => $limit,
            'Offset' => $offset,
            'Next' => $next,
            'MemberInfoFilter' => $member_info_filter,
            'MemberRoleFilter' => $member_role_filter,
            'AppDefinedDataFilter_GroupMember' => $app_defined_data_filter_group_member,
        ]);
    }

    /**
     * 修改群组基础资料.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1620
     * @param string $group_id 需要修改基础信息的群组的 ID
     * @param string|null $name 群名称，最长30字节
     * @param string|null $introduction 群简介，最长240字节
     * @param string|null $notification 群公告，最长300字节
     * @param string|null $face_url 群头像 URL，最长100字节
     * @param int|null $max_member_num 最大群成员数量，最大为6000
     * @param string|null $apply_join_option 申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群）
     * @param array|null $app_defined_data 默认情况是没有的。开通群组维度的自定义字段详情请参见 自定义字段
     * @param string|null $shut_up_all_member 群内群成员禁言，只有群管理员和群主以及系统管理员可以发言
     * @return mixed 返回值
     */
    public function modify_group_base_info(string $group_id, ?string $name = null, ?string $introduction = null, ?string $notification = null, ?string $face_url = null, ?int $max_member_num = null, ?string $apply_join_option = null, ?array $app_defined_data = null, ?string $shut_up_all_member = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Name' => $name,
            'Introduction' => $introduction,
            'Notification' => $notification,
            'FaceUrl' => $face_url,
            'MaxMemberNum' => $max_member_num,
            'ApplyJoinOption' => $apply_join_option,
            'AppDefinedData' => $app_defined_data,
            'ShutUpAllMember' => $shut_up_all_member,
        ]);
    }

    /**
     * 增加群组成员.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1621
     * @param string $group_id 操作的群 ID
     * @param array<int, string> $member_list 待添加的群成员数组
     * @param int|null $silence 是否静默加人。0：非静默加人；1：静默加人。不填该字段默认为0
     * @return mixed 返回值
     */
    public function add_group_member(string $group_id, array $member_list, ?int $silence = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Silence' => $silence,
            'MemberList' => array_map(function ($id) {
                return ['Member_Account' => (string) $id];
            }, $member_list),
        ]);
    }

    /**
     * 删除群组成员.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1622
     * @desc      AVChatRoom（直播群）不支持删除群成员，对这种类型的群组进行操作时会返回10004错误。如果管理员希望达到删除群成员的效果，可以通过设置 批量禁言和取消禁言 的方式实现。
     * @param string $group_id 操作的群 ID
     * @param array<int, string> $member_todel_account 待删除的群成员
     * @param string|null $reason 踢出用户原因
     * @param int|null $silence 是否静默删人。0表示非静默删人，1表示静默删人。静默即删除成员时不通知群里所有成员，只通知被删除群成员。不填写该字段时默认为0
     * @return mixed 返回值
     */
    public function delete_group_member(string $group_id, array $member_todel_account, ?string $reason = null, ?int $silence = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Silence' => $silence,
            'Reason' => $reason,
            'MemberToDel_Account' => $member_todel_account,
        ]);
    }

    /**
     * 修改群成员资料.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1623
     * @desc      AVChatRoom（直播群）因为内部实现的问题，只能修改管理员和群主的成员资料，修改普通成员资料时会返回10007错误。
     * @param string $group_id 操作的群 ID
     * @param string $member_account 要操作的群成员
     * @param int|null $shut_up_time 需禁言时间，单位为秒，0表示取消禁言
     * @param string|null $role 成员身份，Admin/Member 分别为设置/取消管理员
     * @param string|null $msg_flag 消息屏蔽类型
     * @param string|null $name_card 群名片（最大不超过50个字节）
     * @param array<int array<string, string>>|null $app_member_defined_data 群成员维度的自定义字段，默认情况是没有的，需要开通，详情请参阅 群组系统
     * @return mixed 返回值
     */
    public function modify_group_member_info(string $group_id, string $member_account, ?int $shut_up_time = null, ?string $role = null, ?string $msg_flag = null, ?string $name_card = null, ?array $app_member_defined_data = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Member_Account' => $member_account,
            'Role' => $role,
            'MsgFlag' => $msg_flag,
            'NameCard' => $name_card,
            'AppMemberDefinedData' => $app_member_defined_data,
            'ShutUpTime' => $shut_up_time,
        ]);
    }

    /**
     * 解散群组.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1624
     * @param string $group_id 操作的群 ID
     * @return mixed 返回值
     */
    public function destroy_group(string $group_id)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
        ]);
    }

    /**
     * 获取用户所加入的群组.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1625
     * @param string $member_account 需要查询的用户帐号
     * @param int|null $with_huge_groups 是否获取用户加入的音视频聊天室和在线成员广播大群，0表示不获取，1表示获取。默认为0
     * @param int|null $with_no_active_groups 是否获取用户加入的未激活私有群信息，0表示不获取，1表示获取。默认为0
     * @param string|null $group_type 拉取哪种群组形态，例如 Private，Public，ChatRoom 或 AVChatRoom，不填为拉取所有
     * @param int|null $limit 单次拉取的群组数量，如果不填代表所有群组，分页方式与 获取 App 中的所有群组 相同
     * @param int|null $offset 从第多少个群组开始拉取，分页方式与 获取 App 中的所有群组 相同
     * @param array<int array<int, string>>|null $response_filter 分别包含 GroupBaseInfoFilter 和 SelfInfoFilter 两个过滤器； GroupBaseInfoFilter 表示需要拉取哪些基础信息字段，详情请参阅 群组系统；SelfInfoFilter 表示需要拉取用户在每个群组中的哪些个人资料，详情请参阅 群组系统
     * @return mixed 返回值
     */
    public function get_joined_group_list(string $member_account, ?int $with_huge_groups = null, ?int $with_no_active_groups = null, ?string $group_type = null, ?int $limit = null, ?int $offset = null, ?array $response_filter = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'Member_Account' => $member_account,
            'WithHugeGroups' => $with_huge_groups,
            'WithNoActiveGroups' => $with_no_active_groups,
            'Limit' => $limit,
            'Offset' => $offset,
            'GroupType' => $group_type,
            'ResponseFilter' => $response_filter,
        ]);
    }

    /**
     * 查询用户在群组中的身份.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1626
     * @desc      AVChatRoom（直播群）不支持该接口，对此类型群组进行操作将返回10007错误；但可以通过 获取群组成员详细资料 达到查询“成员角色”的效果。
     * @param string $group_id 需要查询的群组 ID
     * @param array<int, string> $user_account 表示需要查询的用户帐号，最多支持500个帐号
     * @return mixed 返回值
     */
    public function get_role_in_group(string $group_id, array $user_account)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'User_Account' => array_map('strval', $user_account),
        ]);
    }

    /**
     * 批量禁言和取消禁言
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1627
     * @desc      私有群不支持禁言。在线成员广播大群只有 App 管理员可以发送消息，所以无需支持设置和取消禁言。
     * @param string $group_id 需要查询的群组 ID
     * @param array<int, string> $members_account 需要禁言的用户帐号，最多支持500个帐号
     * @param int $shut_up_time 需禁言时间，单位为秒，为0时表示取消禁言
     * @return mixed 返回值
     */
    public function forbid_send_msg(string $group_id, array $members_account, int $shut_up_time)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Members_Account' => array_map('strval', $members_account),
            'ShutUpTime' => $shut_up_time,
        ]);
    }

    /**
     * 获取群组被禁言用户列表.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/2925
     * @param string $group_id 需要获取被禁言成员列表的群组 ID
     * @return mixed 返回值
     */
    public function get_group_shutted_uin(string $group_id)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
        ]);
    }

    /**
     * 在群组中发送普通消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1629
     * @param string $group_id 向哪个群组发送消息
     * @param \luoyy\Tim\Support\MsgBody $msg_body 消息体
     * @param string|null $from_account 消息来源帐号
     * @param string|null $msg_priority 消息的优先级
     * @param \luoyy\Tim\Support\OfflinePushInfo|null $offline_push_info 离线推送信息配置
     * @param array|null $forbid_callback_control 消息回调禁止开关
     * @param int|null $online_only_flag 1表示消息仅发送在线成员，默认0表示发送所有成员，音视频聊天室（AVChatRoom）和在线成员广播大群（BChatRoom）不支持该参数
     * @param array<int, string>|null $send_msg_control 消息发送权限，NoLastMsg 只对单条消息有效，表示不更新最近联系人会话；NoUnread 不计未读，只对单条消息有效。（如果该消息 OnlineOnlyFlag 设置为1，则不允许使用该字段。）
     * @param string|null $cloud_custom_data 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     * @param array<int, string> $accounts 指定消息接收者(接收者成员上限50个)，如果此字段被使用，消息则不计未读，仅旗舰版支持此功能，支持群类型 Private、Public、ChatRoom
     * @return mixed 返回值
     */
    public function send_group_msg(string $group_id, MsgBody $msg_body, ?string $from_account = null, ?string $msg_priority = null, ?OfflinePushInfo $offline_push_info = null, ?array $forbid_callback_control = null, ?int $online_only_flag = null, ?array $send_msg_control = null, ?string $cloud_custom_data = null, ?array $accounts = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Random' => $this->getMsgRandom(),
            'MsgPriority' => $msg_priority,
            'MsgBody' => $msg_body->toArray(),
            'From_Account' => $from_account,
            'OfflinePushInfo' => !is_null($offline_push_info) ? $offline_push_info->toArray() : $offline_push_info,
            'ForbidCallbackControl' => $forbid_callback_control,
            'OnlineOnlyFlag' => $online_only_flag,
            'SendMsgControl' => $send_msg_control,
            'CloudCustomData' => $cloud_custom_data,
            'To_Account' => array_map('strval', $accounts),
        ]);
    }

    /**
     * 在群组中发送系统通知.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1630
     * @desc      非直播群支持向群组中的一部分指定成员发送系统通知，而 AVChatRoom（直播群）只支持向群组中所有成员发送系统通知。
     * @param string $group_id 向哪个群组发送系统通知
     * @param string $content 系统通知的内容
     * @param array<int, string>|null $to_members_account 接收者群成员列表，不填或为空表示全员下发
     * @return mixed 返回值
     */
    public function send_group_system_notification(string $group_id, string $content, ?array $to_members_account = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'ToMembers_Account' => !is_null($to_members_account) ? array_map('strval', $to_members_account) : null,
            'Content' => $content,
        ]);
    }

    /**
     * 转让群组.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1633
     * @param string $group_id 要被转移的群组 ID
     * @param string $new_owner_account 新群主 ID
     * @return mixed 返回值
     */
    public function change_group_owner(string $group_id, string $new_owner_account)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'NewOwner_Account' => $new_owner_account,
        ]);
    }

    /**
     * 撤回群组消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/12341
     * @param string $group_id 操作的群 ID
     * @param array<int, int> $msg_seq_list 被撤回的消息 seq 列表，一次请求最多可以撤回10条消息 seq(传递seq数组即可，会自动处理二维结构)
     * @return mixed 返回值
     */
    public function group_msg_recall(string $group_id, array $msg_seq_list)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'MsgSeqList' => array_map(function ($id) {
                return ['MsgSeq' => (int) $id];
            }, $msg_seq_list),
        ]);
    }

    /**
     * 导入群基础资料.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1634
     * @desc      音视频聊天室和在线成员广播大群不支持导入群基础资料，对这两种类型的群组进行操作时会返回 10007 错误；如果需要达到导入群组基础资料的效果，可以通过 创建群组 和 修改群组基础资料 的方式实现。
     * @param string $name 群名称，最长30字节
     * @param string $type 群组形态，包括 Public（公开群），Private（私密群）， ChatRoom（聊天室）
     * @param string|null $owner_account 群主 ID，自动添加到群成员中。如果不填，群没有群主
     * @param string|null $group_id 为了使得群组 ID 更加简单，便于记忆传播，腾讯云支持 App 在通过 REST API 创建群组时自定义群组 ID。详细请参阅 群组系统
     * @param int|null $create_time 群组的创建时间
     * @param int|null $max_member_count 最大群成员数量，最大为6000，不填默认为2000个
     * @param string|null $apply_join_option 申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群），不填默认为NeedPermission（需要验证）
     * @param string|null $introduction 群简介，最长240字节
     * @param string|null $notification 群公告，最长300字节
     * @param string|null $face_url 群头像 URL，最长100字节
     * @param array|null $app_defined_data 群组维度的自定义字段，默认情况是没有的，需要开通，详细请参阅 群组系统
     * @return mixed 返回值
     */
    public function import_group(string $name, string $type, ?string $owner_account = null, ?string $group_id = null, ?int $create_time = null, ?int $max_member_count = null, ?string $apply_join_option = null, ?string $introduction = null, ?string $notification = null, ?string $face_url = null, ?array $app_defined_data = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'Owner_Account' => $owner_account,
            'Type' => $type,
            'GroupId' => $group_id,
            'Name' => $name,
            'Introduction' => $introduction,
            'Notification' => $notification,
            'FaceUrl' => $face_url,
            'MaxMemberCount' => $max_member_count,
            'ApplyJoinOption' => $apply_join_option,
            'AppDefinedData' => $app_defined_data,
            'CreateTime' => $create_time,
        ]);
    }

    /**
     * 导入群消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1635
     * @param string $group_id 要导入消息的群 ID
     * @param array<int, array> $msg_list 导入的消息列表
     * @param int|null $recent_contact_flag 会话更新识别，为1的时候标识触发会话更新，默认不触发（avchatroom 群不支持）
     * @return mixed 返回值
     */
    public function import_group_msg(string $group_id, array $msg_list, ?int $recent_contact_flag = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'RecentContactFlag' => $recent_contact_flag,
            'MsgList' => $msg_list,
        ]);
    }

    /**
     * 导入群成员.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1636
     * @param string $group_id 操作的群 ID
     * @param array<int, array> $member_list 待添加的群成员数组
     * @return mixed 返回值
     */
    public function import_group_member(string $group_id, array $member_list)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'MemberList' => $member_list,
        ]);
    }

    /**
     * 设置成员未读消息计数.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1637
     * @param string $group_id 操作的群 ID
     * @param string $member_account 要操作的群成员
     * @param int $unread_msg_num 成员未读消息数
     */
    public function set_unread_msg_num(string $group_id, string $member_account, int $unread_msg_num)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Member_Account' => $member_account,
            'UnreadMsgNum' => $unread_msg_num,
        ]);
    }

    /**
     * 删除指定用户发送的消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/2359
     * @param string $group_id 要删除消息的群 ID
     * @param string $sender_account 被删除消息的发送者 ID
     * @return mixed 返回值
     */
    public function delete_group_msg_by_sender(string $group_id, string $sender_account)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'Sender_Account' => $sender_account,
        ]);
    }

    /**
     * 拉取群漫游消息.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/2359
     * @param string $group_id 要拉取漫游消息的群组 ID
     * @param int $req_msg_number 拉取的漫游消息的条数，目前一次请求最多返回20条漫游消息，所以这里最好小于等于20
     * @param int|null $req_msg_seq 拉取消息的最大 seq
     * @param int|null $with_recalled_msg 是否带撤回的消息，填1表明需要拉取撤回后的消息；默认不拉取撤回后的消息
     * @return mixed 返回值
     */
    public function group_msg_get_simple(string $group_id, int $req_msg_number, ?int $req_msg_seq = null, ?int $with_recalled_msg = null)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'ReqMsgNumber' => $req_msg_number,
            'ReqMsgSeq' => $req_msg_seq,
            'WithRecalledMsg' => $with_recalled_msg,
        ]);
    }

    /**
     * 获取直播群在线人数.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/49180
     * @param string $group_id 要拉取漫游消息的群组 ID
     * @return mixed 返回值
     */
    public function get_online_member_num(string $group_id)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
        ]);
    }

    /**
     * 获取群自定义属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/67012
     * @param string $group_id 获取自定义属性的群id
     * @return mixed 返回值
     */
    public function get_group_attr(string $group_id)
    {
        return $this->api('group_open_attr_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
        ]);
    }

    /**
     * 修改群自定义属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/67010
     * @param string $group_id 获取自定义属性的群id
     * @param array<int, array<string, string>> $group_attr 自定义属性列表，key 为自定义属性的键，value 为自定义属性的值
     * @return mixed 返回值
     */
    public function modify_group_attr(string $group_id, array $group_attr)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'GroupAttr' => $group_attr,
        ]);
    }

    /**
     * 清空群自定义属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/67009
     * @param string $group_id 清空自定义属性的群 id
     * @return mixed 返回值
     */
    public function clear_group_attr(string $group_id)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
        ]);
    }

    /**
     * 重置群自定义属性.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/67011
     * @param string $group_id 清空自定义属性的群 id
     * @param array<int, array<string, string>> $group_attr 自定义属性列表，key 为自定义属性的键，value 为自定义属性的值
     * @return mixed 返回值
     */
    public function set_group_attr(string $group_id, array $group_attr)
    {
        return $this->api('group_open_http_svc', __FUNCTION__, [
            'GroupId' => $group_id,
            'GroupAttr' => $group_attr,
        ]);
    }

    /**
     * ============
     * 群组管理结束
     * ============.
     */

    /**
     * ================
     * 全局禁言管理开始
     * ================.
     */

    /**
     * 全局禁言管理 openconfigsvr.
     */

    /**
     * 设置全局禁言
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/4230
     * @param string $set_account 设置禁言配置的帐号
     * @param int|null $c2cmsg_nospeaking_time 单聊消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）。等于0代表取消帐号禁言；等于最大值4294967295（十六进制 0xFFFFFFFF）代表帐号被设置永久禁言；其它代表该帐号禁言时间
     * @param int|null $groupmsg_nospeaking_time 群组消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）。等于0代表取消帐号禁言；最大值4294967295（十六进制 0xFFFFFFFF）代表帐号被设置永久禁言；其它代表该帐号禁言时间
     * @return mixed 返回值
     */
    public function setnospeaking(string $set_account, ?int $c2cmsg_nospeaking_time = null, ?int $groupmsg_nospeaking_time = null)
    {
        return $this->api('openconfigsvr', __FUNCTION__, [
            'Set_Account' => $set_account,
            'C2CmsgNospeakingTime' => $c2cmsg_nospeaking_time,
            'GroupmsgNospeakingTime' => $groupmsg_nospeaking_time,
        ]);
    }

    /**
     * 查询全局禁言
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/4229
     * @param string $get_account 查询禁言信息的帐号
     * @return mixed 返回值
     */
    public function getnospeaking(string $get_account)
    {
        return $this->api('openconfigsvr', __FUNCTION__, [
            'Get_Account' => $get_account,
        ]);
    }

    /**
     * ================
     * 全局禁言管理结束
     * ================.
     */

    /**
     * ============
     * 运营管理开始
     * ============.
     */

    /**
     * 运营管理 openconfigsvr open_msg_svc ConfigSvc.
     */

    /**
     * 拉取运营数据.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/4193
     * @return mixed 返回值
     */
    public function getappinfo(string ...$request_field)
    {
        return $this->api('openconfigsvr', __FUNCTION__, [
            'RequestField' => $request_field ?: null,
        ]);
    }

    /**
     * 下载消息记录.
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/1650
     * @param string $chat_type 消息类型，C2C 表示单发消息 Group 表示群组消息
     * @param string $msg_time 需要下载的消息记录的时间段，2015120121表示获取2015年12月1日21:00 - 21:59的消息的下载地址。该字段需精确到小时。每次请求只能获取某天某小时的所有单发或群组消息记录
     * @return mixed 返回值
     */
    public function get_history(string $chat_type, string $msg_time)
    {
        return $this->api('open_msg_svc', __FUNCTION__, [
            'ChatType' => $chat_type,
            'MsgTime' => $msg_time,
        ]);
    }

    /**
     * 获取服务器 IP 地址
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45438
     * @return mixed 返回值
     */
    public function get_ip_list()
    {
        return $this->GetIPList();
    }

    /**
     * 获取服务器 IP 地址
     * @copyright (c) zishang520 All Rights Reserved
     * @see      https://cloud.tencent.com/document/product/269/45438
     * @return mixed 返回值
     */
    public function GetIPList()
    {
        return $this->api('ConfigSvc', __FUNCTION__, []);
    }

    /*
     * ============
     * 运营管理结束
     * ============
     */
}
