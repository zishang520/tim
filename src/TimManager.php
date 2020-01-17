<?php
namespace luoyy\Tim;

use luoyy\Tim\Tim;

/**
 * TimManager
 */
class TimManager extends Tim
{

    /**
     * 账户管理 im_open_login_svc
     */

    /**
     * [account_import 单个帐号导入接口]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T16:13:22+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $identifier [用户名，长度不超过32字节]
     * @param     string $nick [用户昵称]
     * @param     string $face_url [用户头像 URL]
     * @return    [type] [description]
     */
    public function account_import(string $identifier, string $nick, string $face_url)
    {
        return $this->api('im_open_login_svc', 'account_import', [
            'Identifier' => $identifier,
            'Nick' => $nick,
            'FaceUrl' => $face_url
        ]);
    }

    /**
     * [multiaccount_import 批量帐号导入接口]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T16:13:05+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     array $accounts [用户名，单个用户名长度不超过32字节，单次最多导入100个用户名]
     * @return    [type] [description]
     */
    public function multiaccount_import(array $accounts)
    {
        return $this->api('im_open_login_svc', 'account_import', [
            'Accounts' => array_map('strval', $accounts)
        ]);
    }

    /**
     * [account_delete 帐号删除接口]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T16:18:39+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     array $user_ids [ids]
     * @return    [type] [description]
     */
    public function account_delete(array $user_ids)
    {
        return $this->api('im_open_login_svc', 'account_delete', [
            'DeleteItem' => array_map(function ($id) {
                return ['UserID' => (string) $id];
            }, $user_ids)
        ]);
    }

    /**
     * [account_check 帐号检查接口]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T16:28:29+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     array $user_ids [ids]
     * @return    [type] [description]
     */
    public function account_check(array $user_ids)
    {
        return $this->api('im_open_login_svc', 'account_check', [
            'CheckItem' => array_map(function ($id) {
                return ['UserID' => (string) $id];
            }, $user_ids)
        ]);
    }

    /**
     * [kick 帐号登录态失效接口]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T16:30:25+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $identifier [用户名]
     * @return    [type] [description]
     */
    public function kick(string $identifier)
    {
        return $this->api('im_open_login_svc', 'kick', [
            'Identifier' => $identifier
        ]);
    }

    /**
     * 在线状态 openim
     */

    /**
     * [querystate 获取用户在线状态]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T16:31:44+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     array $accounts [需要查询这些 Identifier 的登录状态，一次最多查询500个 Identifier 的状态]
     * @return    [type] [description]
     */
    public function querystate(array $accounts)
    {
        return $this->api('openim', 'querystate', [
            'To_Account' => array_map('strval', $accounts)
        ]);
    }

    /**
     * 资料管理 profile
     */

    /**
     * [portrait_get 拉取资料]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T16:48:07+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     array $accounts [需要拉取这些 Identifier 的资料]
     * @param     array $tag_list [指定要拉取的资料字段的 Tag]
     * @return    [type] [description]
     */
    public function portrait_get(array $accounts, array $tag_list)
    {
        return $this->api('profile', 'portrait_get', [
            'To_Account' => array_map('strval', $accounts),
            'TagList' => $tag_list
        ]);
    }

    /**
     * [portrait_set 设置资料]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:01:27+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要设置该 Identifier 的资料]
     * @param     array $profile_item [{ "Tag":"Tag_Profile_IM_Nick", "Value":"MyNickName" },{ "Tag":"Tag_Profile_IM_Nick", "Value":"MyNickName" }]
     * @return    [type] [description]
     */
    public function portrait_set(string $from_account, array $profile_item)
    {
        return $this->api('profile', 'portrait_set', [
            'From_Account' => $from_account,
            'ProfileItem' => $profile_item
        ]);
    }

    /**
     * 关系链管理 sns
     */

    /**
     * [friend_add description]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:33:32+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要为该 UserID 添加好友]
     * @param     array $add_friend_item [好友结构体对象]
     * @param     string $add_type [加好友方式（默认双向加好友方式）]
     * @param     int|integer $force_add_flags [管理员强制加好友标记：1表示强制加好友，0表示常规加好友方式]
     * @return    [type] [description]
     */
    public function friend_add(string $from_account, array $add_friend_item, string $add_type = null, int $force_add_flags = null)
    {
        return $this->api('sns', 'friend_add', [
            'From_Account' => $from_account,
            'AddFriendItem' => $add_friend_item,
            'AddType' => $add_type,
            'ForceAddFlags' => $force_add_flags
        ]);
    }

    /**
     * [friend_import 导入好友]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:40:05+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要为该 UserID 添加好友]
     * @param     array $add_friend_item [好友结构体对象]
     * @return    [type] [description]
     */
    public function friend_import(string $from_account, array $add_friend_item)
    {
        return $this->api('sns', 'friend_import', [
            'From_Account' => $from_account,
            'AddFriendItem' => $add_friend_item
        ]);
    }

    /**
     * [friend_delete 删除好友]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:45:29+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [指定要清除好友数据的用户的 UserID]
     * @param     array $accounts [description]
     * @param     string|null $deletet_type [删除模式]
     * @return    [type] [description]
     */
    public function friend_delete(string $from_account, array $accounts, string $deletet_type = null)
    {
        return $this->api('sns', 'friend_delete', [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'DeleteType' => $deletet_type
        ]);
    }

    /**
     * [friend_delete_all 删除所有好友]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:46:55+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [指定要清除好友数据的用户的 UserID]
     * @param     string|null $deletet_type [删除模式]
     * @return    [type] [description]
     */
    public function friend_delete_all(string $from_account, string $deletet_type = null)
    {
        return $this->api('sns', 'friend_delete_all', [
            'From_Account' => $from_account,
            'DeleteType' => $deletet_type
        ]);
    }

    /**
     * [friend_check 校验好友]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:48:46+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要校验该 UserID 的好友]
     * @param     array $accounts [请求校验的好友的 UserID 列表，单次请求的 To_Account 数不得超过1000]
     * @param     string $check_type [校验模式]
     * @return    [type] [description]
     */
    public function friend_check(string $from_account, array $accounts, string $check_type)
    {
        return $this->api('sns', 'friend_check', [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'CheckType' => $check_type
        ]);
    }

    /**
     * [friend_get 拉取好友]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:51:48+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [指定要拉取好友数据的用户的 UserID]
     * @param     int|integer $start_index [分页的起始位置]
     * @param     int|integer $standard_sequence [上次拉好友数据时返回的 StandardSequence，如果 StandardSequence 字段的值与后台一致，后台不会返回标配好友数据]
     * @param     int|integer $custom_sequence [上次拉好友数据时返回的 CustomSequence，如果 CustomSequence 字段的值与后台一致，后台不会返回自定义好友数据]
     * @return    [type] [description]
     */
    public function friend_get(string $from_account, int $start_index = 0, int $standard_sequence = 0, int $custom_sequence = 0)
    {
        return $this->api('sns', 'friend_get', [
            'From_Account' => $from_account,
            'StartIndex' => $start_index,
            'StandardSequence' => $standard_sequence,
            'CustomSequence' => $custom_sequence
        ]);
    }

    /**
     * [friend_get_list 拉取指定好友]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:54:21+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [指定要拉取好友数据的用户的 UserID]
     * @param     array $accounts [好友的 UserID 列表]
     * @param     array $tag_list [指定要拉取的资料字段及好友字段]
     * @return    [type] [description]
     */
    public function friend_get_list(string $from_account, array $accounts, array $tag_list)
    {
        return $this->api('sns', 'friend_get_list', [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'TagList' => $tag_list
        ]);
    }

    /**
     * [black_list_add 添加黑名单]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T17:58:54+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [请求为该 UserID 添加黑名单]
     * @param     array $accounts [待添加为黑名单的用户 UserID 列表，单次请求的 To_Account 数不得超过1000]
     * @return    [type] [description]
     */
    public function black_list_add(string $from_account, array $accounts)
    {
        return $this->api('sns', 'black_list_add', [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts)
        ]);
    }

    /**
     * [black_list_delete 删除黑名单]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T18:01:34+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要删除该 UserID 的黑名单]
     * @param     array $accounts [待添加为黑名单的用户 UserID 列表，单次请求的 To_Account 数不得超过1000]
     * @return    [type] [description]
     */
    public function black_list_delete(string $from_account, array $accounts)
    {
        return $this->api('sns', 'black_list_delete', [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts)
        ]);
    }

    /**
     * [black_list_get 拉取黑名单]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T18:03:17+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要拉取该 UserID 的黑名单]
     * @param     int|integer $start_index [拉取的起始位置]
     * @param     int|integer $max_limited [每页最多拉取的黑名单数]
     * @param     int|integer $last_sequence [上一次拉黑名单时后台返回给客户端的 Seq，初次拉取时为0]
     * @return    [type] [description]
     */
    public function black_list_get(string $from_account, int $start_index = 0, int $max_limited = 30, int $last_sequence = 0)
    {
        return $this->api('sns', 'black_list_get', [
            'From_Account' => $from_account,
            'StartIndex' => $start_index,
            'MaxLimited' => $max_limited,
            'LastSequence' => $last_sequence
        ]);
    }

    /**
     * [black_list_check 校验黑名单]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T18:04:58+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要校验该 UserID 的黑名单]
     * @param     array $accounts [待校验的黑名单的 UserID 列表，单次请求的 To_Account 数不得超过1000]
     * @param     string $check_type [校验模式]
     * @return    [type] [description]
     */
    public function black_list_check(string $from_account, array $accounts, string $check_type)
    {
        return $this->api('sns', 'black_list_check', [
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'CheckType' => $check_type
        ]);
    }

    /**
     * [group_add 添加分组]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T18:15:37+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要为该 UserID 添加新分组]
     * @param     array $group_name [新增分组列表]
     * @param     array|null $accounts [需要加入新增分组的好友的 UserID 列表]
     * @return    [type] [description]
     */
    public function group_add(string $from_account, array $group_name, array $accounts = null)
    {
        return $this->api('sns', 'group_add', [
            'From_Account' => $from_account,
            'GroupName' => array_map('strval', $group_name),
            'To_Account' => !is_null($accounts) ? array_map('strval', $accounts) : null
        ]);
    }

    /**
     * [group_delete 删除分组]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-15T18:16:28+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [需要删除该 UserID 的分组]
     * @param     array $group_name [要删除的分组列表]
     * @return    [type] [description]
     */
    public function group_delete(string $from_account, array $group_name)
    {
        return $this->api('sns', 'group_delete', [
            'From_Account' => $from_account,
            'GroupName' => array_map('strval', $group_name)
        ]);
    }

    /**
     * 单聊消息 openim
     */

    /**
     * [sendmsg 单发单聊消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T10:28:47+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $to_account [消息接收方 Identifier]
     * @param     array $msg_body [消息内容]
     * @param     string|null $from_account [消息发送方 Identifier（用于指定发送消息方帐号）]
     * @param     array|null $offline_push_info [离线推送信息配置]
     * @param     int|integer $sync_other_machine [1：把消息同步到 From_Account 在线终端和漫游上； 2：消息不同步至 From_Account； 若不填写默认情况下会将消息存 From_Account 漫游]
     * @param     int|integer $msg_life_time [消息离线保存时长（单位：秒），最长为7天（604800秒）]
     * @return    [type] [description]
     */
    public function sendmsg(string $to_account, array $msg_body, string $from_account = null, array $offline_push_info = null, int $sync_other_machine = 2, int $msg_life_time = 604800)
    {
        return $this->api('openim', 'sendmsg', [
            'SyncOtherMachine' => $sync_other_machine,
            'From_Account' => $from_account,
            'To_Account' => $to_account,
            'MsgLifeTime' => $msg_life_time,
            'MsgRandom' => mt_rand(0, 4294967295),
            'MsgTimeStamp' => time(),
            'MsgBody' => $msg_body,
            'OfflinePushInfo' => $offline_push_info
        ]);
    }

    /**
     * [batchsendmsg 批量发单聊消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T10:32:34+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     array $accounts [消息接收方 Identifier]
     * @param     array $msg_body [TIM 消息]
     * @param     string|null $from_account [消息发送方 Identifier，用于指定发送消息方]
     * @param     array|null $offline_push_info [离线推送信息配置]
     * @param     int|integer $sync_other_machine [该字段只能填1或2，其他值是非法值 1表示实时消息导入，消息加入未读计数 2表示历史消息导入，消息不计入未读]
     * @return    [type] [description]
     */
    public function batchsendmsg(array $accounts, array $msg_body, string $from_account = null, array $offline_push_info = null, int $sync_other_machine = 2)
    {
        return $this->api('openim', 'batchsendmsg', [
            'SyncOtherMachine' => $sync_other_machine,
            'From_Account' => $from_account,
            'To_Account' => array_map('strval', $accounts),
            'MsgRandom' => mt_rand(0, 4294967295),
            'MsgBody' => $msg_body,
            'OfflinePushInfo' => $offline_push_info
        ]);
    }

    /**
     * [importmsg 导入单聊消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T10:36:30+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [消息发送方 Identifier，用于指定发送消息方]
     * @param     string $to_account [消息接收方 Identifier]
     * @param     array $msg_body [消息内容]
     * @param     int|integer $sync_other_machine [该字段只能填1或2，其他值是非法值 1表示实时消息导入，消息加入未读计数 2表示历史消息导入，消息不计入未读]
     * @return    [type] [description]
     */
    public function importmsg(string $from_account, string $to_account, array $msg_body, int $sync_other_machine = 2)
    {
        return $this->api('openim', 'importmsg', [
            'SyncOtherMachine' => $sync_other_machine,
            'From_Account' => $from_account,
            'To_Account' => $to_account,
            'MsgRandom' => mt_rand(0, 4294967295),
            'MsgTimeStamp' => time(),
            'MsgBody' => $msg_body
        ]);
    }

    /**
     * [admin_msgwithdraw 撤回单聊消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T10:39:34+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $from_account [消息发送方 UserID]
     * @param     string $to_account [消息接收方 UserID]
     * @param     string $msg_key [待撤回消息的唯一标识。该字段由 REST API 接口 单发单聊消息 和 批量发单聊消息 返回]
     * @return    [type] [description]
     */
    public function admin_msgwithdraw(string $from_account, string $to_account, string $msg_key)
    {
        return $this->api('openim', 'admin_msgwithdraw', [
            'From_Account' => $from_account,
            'To_Account' => $to_account,
            'MsgKey' => $msg_key
        ]);
    }

    /**
     * 群组管理 group_open_http_svc
     */

    /**
     * [get_appid_group_list description]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T10:41:50+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     int|null $limit [本次获取的群组 ID 数量的上限，不得超过 10000。如果不填，默认为最大值 10000]
     * @param     int|null $next [群太多时分页拉取标志，第一次填0，以后填上一次返回的值，返回的 Next 为0代表拉完了]
     * @param     string|null $group_type [如果仅需要返回特定群组形态的群组，可以通过 GroupType 进行过滤，但此时返回的 TotalCount 的含义就变成了 App 中属于该群组形态的群组总数。不填为获取所有类型的群组。 群组形态包括 Public（公开群），Private（私密群），ChatRoom（聊天室），AVChatRoom（音视频聊天室）和 BChatRoom（在线成员广播大群）]
     * @return    [type] [description]
     */
    public function get_appid_group_list(int $limit = null, int $next = null, string $group_type = null)
    {
        return $this->api('group_open_http_svc', 'get_appid_group_list', [
            'Limit' => $limit,
            'Next' => $next,
            'GroupType' => $group_type
        ]);
    }

    /**
     * [create_group 创建群组]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T11:07:48+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $name [群名称，最长30字节，使用 UIT-8 编码，1个汉字占3个字节]
     * @param     string $type [群组形态，包括 Public（公开群），Private（私密群），ChatRoom（聊天室），AVChatRoom（音视频聊天室），BChatRoom（在线成员广播大群）]
     * @param     string|null $owner_account [群主 ID，自动添加到群成员中。如果不填，群没有群主]
     * @param     string|null $group_id [为了使得群组 ID 更加简单，便于记忆传播，腾讯云支持 App 在通过 REST API 创建群组时 自定义群组 ID]
     * @param     array|null $member_list [初始群成员列表，最多500个；成员信息字段详情请参阅 群成员资料]
     * @param     int|null $max_member_count [最大群成员数量，缺省时的默认值：私有群是200，公开群是2000，聊天室是6000，音视频聊天室和在线成员广播大群无限制]
     * @param     string|null $apply_join_option [申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群），不填默认为 NeedPermission（需要验证） 仅当创建支持申请加群的 群组 时，该字段有效]
     * @param     string|null $introduction [群简介，最长240字节，使用 UIT-8 编码，1个汉字占3个字节]
     * @param     string|null $notification [群公告，最长300字节，使用 UIT-8 编码，1个汉字占3个字节]
     * @param     string|null $face_url [群头像 URL，最长100字节]
     * @param     array|null $app_defined_data [群组维度的自定义字段，默认情况是没有的，需要开通，详情请参阅 自定义字段]
     * @param     array|null $app_member_defined_data [群成员维度的自定义字段，默认情况是没有的，需要开通，详情请参阅 自定义字段]
     * @return    [type] [description]
     */
    public function create_group(string $name, string $type, string $owner_account = null, string $group_id = null, array $member_list = null, int $max_member_count = null, string $apply_join_option = null, string $introduction = null, string $notification = null, string $face_url = null, array $app_defined_data = null, array $app_member_defined_data = null)
    {
        return $this->api('group_open_http_svc', 'create_group', [
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
            'AppMemberDefinedData' => $app_member_defined_data
        ]);
    }

    /**
     * [get_group_info 获取群组详细资料]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T11:20:58+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     array $group_id_list [需要拉取的群组列表]
     * @param     array|null $response_filter [包含三个过滤器：GroupBaseInfoFilter，MemberInfoFilter，AppDefinedDataFilter_Group，分别是基础信息字段过滤器，成员信息字段过滤器，群组维度的自定义字段过滤器]
     * @return    [type] [description]
     */
    public function get_group_info(array $group_id_list, array $response_filter = null)
    {
        return $this->api('group_open_http_svc', 'get_group_info', [
            'GroupIdList' => $group_id_list,
            'ResponseFilter' => $response_filter
        ]);
    }

    /**
     * [get_group_member_info 获取群组成员详细资料]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T11:30:55+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [需要拉取成员信息的群组的 ID]
     * @param     int|null $limit [一次最多获取多少个成员的资料，不得超过10000。如果不填，则获取群内全部成员的信息]
     * @param     int|null $offset [从第几个成员开始获取，如果不填则默认为0，表示从第一个成员开始获取]
     * @param     array|null $member_info_filter [需要获取哪些信息， 如果没有该字段则为群成员全部资料，成员信息字段详情请参阅 群成员资料]
     * @param     array|null $member_role_filter [拉取指定身份的群成员资料。如没有填写该字段，默认为所有身份成员资料，成员身份可以为：“Owner”，“Admin”，“Member”]
     * @param     array|null $app_defined_data_filter_group_member [默认情况是没有的。该字段用来群成员维度的自定义字段过滤器，指定需要获取的群成员维度的自定义字段，群成员维度的自定义字段详情请参阅 自定义字段]
     * @return    [type] [description]
     */
    public function get_group_member_info(string $group_id, int $limit = null, int $offset = null, array $member_info_filter = null, array $member_role_filter = null, array $app_defined_data_filter_group_member = null)
    {
        return $this->api('group_open_http_svc', 'get_group_member_info', [
            'GroupId' => $group_id,
            'Limit' => $limit,
            'Offset' => $offset,
            'MemberInfoFilter' => $member_info_filter,
            'MemberRoleFilter' => $member_role_filter,
            'AppDefinedDataFilter_GroupMember' => $app_defined_data_filter_group_member
        ]);
    }

    /**
     * [modify_group_base_info 修改群组基础资料]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T11:40:53+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [需要修改基础信息的群组的 ID]
     * @param     string|null $name [群名称，最长30字节]
     * @param     string|null $introduction [群简介，最长240字节]
     * @param     string|null $notification [群公告，最长300字节]
     * @param     string|null $face_url [群头像 URL，最长100字节]
     * @param     int|null $max_member_num [最大群成员数量，最大为6000]
     * @param     string|null $apply_join_option [申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群）]
     * @param     array|null $app_defined_data [默认情况是没有的。开通群组维度的自定义字段详情请参见 自定义字段]
     * @return    [type] [description]
     */
    public function modify_group_base_info(string $group_id, string $name = null, string $introduction = null, string $notification = null, string $face_url = null, int $max_member_num = null, string $apply_join_option = null, array $app_defined_data = null)
    {
        return $this->api('group_open_http_svc', 'modify_group_base_info', [
            'GroupId' => $group_id,
            'Name' => $name,
            'Introduction' => $introduction,
            'Notification' => $notification,
            'FaceUrl' => $face_url,
            'MaxMemberNum' => $max_member_num,
            'ApplyJoinOption' => $apply_join_option,
            'AppDefinedData' => $app_defined_data
        ]);
    }

    /**
     * [add_group_member 增加群组成员]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T11:54:53+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [操作的群 ID]
     * @param     array $member_list [待添加的群成员数组]
     * @param     int|integer $silence [是否静默加人。0：非静默加人；1：静默加人。不填该字段默认为0]
     * @return    [type] [description]
     */
    public function add_group_member(string $group_id, array $member_list, int $silence = 0)
    {
        return $this->api('group_open_http_svc', 'add_group_member', [
            'GroupId' => $group_id,
            'Silence' => $silence,
            'MemberList' => array_map(function ($id) {
                return ['Member_Account' => (string) $id];
            }, $member_list)
        ]);
    }

    /**
     * [delete_group_member 删除群组成员]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T11:58:25+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [操作的群 ID]
     * @param     array $member_todel_account [待删除的群成员]
     * @param     string|null $reason [踢出用户原因]
     * @param     int|integer $silence [是否静默删人。0表示非静默删人，1表示静默删人。静默即删除成员时不通知群里所有成员，只通知被删除群成员。不填写该字段时默认为0]
     * @return    [type] [description]
     */
    public function delete_group_member(string $group_id, array $member_todel_account, string $reason = null, int $silence = 0)
    {
        return $this->api('group_open_http_svc', 'delete_group_member', [
            'GroupId' => $group_id,
            'Silence' => $silence,
            'Reason' => $reason,
            'MemberToDel_Account' => $member_todel_account
        ]);
    }

    /**
     * [modify_group_member_info 修改群成员资料]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T12:03:31+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [操作的群 ID]
     * @param     string $member_account [要操作的群成员]
     * @param     int|null $shut_up_time [需禁言时间，单位为秒，0表示取消禁言]
     * @param     string|null $role [成员身份，Admin/Member 分别为设置/取消管理员]
     * @param     string|null $msg_flag [消息屏蔽类型]
     * @param     string|null $name_card [群名片（最大不超过50个字节）]
     * @param     array|null $app_member_defined_data [群成员维度的自定义字段，默认情况是没有的，需要开通，详情请参阅 群组系统]
     * @return    [type] [description]
     */
    public function modify_group_member_info(string $group_id, string $member_account, int $shut_up_time = null, string $role = null, string $msg_flag = null, string $name_card = null, array $app_member_defined_data = null)
    {
        return $this->api('group_open_http_svc', 'modify_group_member_info', [
            'GroupId' => $group_id,
            'Member_Account' => $member_account,
            'Role' => $role,
            'MsgFlag' => $msg_flag,
            'NameCard' => $name_card,
            'ShutUpTime' => $shut_up_time,
            'AppMemberDefinedData' => $app_member_defined_data
        ]);
    }

    /**
     * [destroy_group 解散群组]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T12:07:09+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [操作的群 ID]
     * @return    [type] [description]
     */
    public function destroy_group(string $group_id)
    {
        return $this->api('group_open_http_svc', 'destroy_group', [
            'GroupId' => $group_id
        ]);
    }

    /**
     * [get_joined_group_list 获取用户所加入的群组]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T12:18:47+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $member_account [需要查询的用户帐号]
     * @param     int|integer $with_huge_groups [是否获取用户加入的音视频聊天室和在线成员广播大群，0表示不获取，1表示获取。默认为0]
     * @param     int|integer $with_no_active_groups [是否获取用户加入的未激活私有群信息，0表示不获取，1表示获取。默认为0]
     * @param     string|null $group_type [拉取哪种群组形态，例如 Private，Public，ChatRoom 或 AVChatRoom，不填为拉取所有]
     * @param     int|null $limit [单次拉取的群组数量，如果不填代表所有群组，分页方式与 获取 App 中的所有群组 相同]
     * @param     int|null $offset [从第多少个群组开始拉取，分页方式与 获取 App 中的所有群组 相同]
     * @param     array|null $response_filter [分别包含 GroupBaseInfoFilter 和 SelfInfoFilter 两个过滤器； GroupBaseInfoFilter 表示需要拉取哪些基础信息字段，详情请参阅 群组系统；SelfInfoFilter 表示需要拉取用户在每个群组中的哪些个人资料，详情请参阅 群组系统]
     * @return    [type] [description]
     */
    public function get_joined_group_list(string $member_account, int $with_huge_groups = 0, int $with_no_active_groups = 0, string $group_type = null, int $limit = null, int $offset = null, array $response_filter = null)
    {
        return $this->api('group_open_http_svc', 'get_joined_group_list', [
            'Member_Account' => $member_account,
            'WithHugeGroups' => $with_huge_groups,
            'WithNoActiveGroups' => $with_no_active_groups,
            'Limit' => $limit,
            'Offset' => $offset,
            'GroupType' => $group_type,
            'ResponseFilter' => $response_filter
        ]);
    }

    /**
     * [get_role_in_group 查询用户在群组中的身份]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T12:27:27+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [需要查询的群组 ID]
     * @param     array $user_account [表示需要查询的用户帐号，最多支持500个帐号]
     * @return    [type] [description]
     */
    public function get_role_in_group(string $group_id, array $user_account)
    {
        return $this->api('group_open_http_svc', 'get_role_in_group', [
            'GroupId' => $group_id,
            'User_Account' => $user_account
        ]);
    }

    /**
     * [forbid_send_msg 批量禁言和取消禁言]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T12:39:31+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [需要查询的群组 ID]
     * @param     array $members_account [需要禁言的用户帐号，最多支持500个帐号]
     * @param     int $shut_up_time [需禁言时间，单位为秒，为0时表示取消禁言]
     * @return    [type] [description]
     */
    public function forbid_send_msg(string $group_id, array $members_account, int $shut_up_time)
    {
        return $this->api('group_open_http_svc', 'forbid_send_msg', [
            'GroupId' => $group_id,
            'Members_Account' => $members_account,
            'ShutUpTime' => $shut_up_time
        ]);
    }

    /**
     * [get_group_shutted_uin 获取群组被禁言用户列表]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T12:52:09+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [需要获取被禁言成员列表的群组 ID。]
     * @return    [type] [description]
     */
    public function get_group_shutted_uin(string $group_id)
    {
        return $this->api('group_open_http_svc', 'get_group_shutted_uin', [
            'GroupId' => $group_id
        ]);
    }

    /**
     * [send_group_msg 在群组中发送普通消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T14:20:29+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [向哪个群组发送消息]
     * @param     array $msg_body [消息体]
     * @param     string|null $from_account [消息来源帐号]
     * @param     string|null $msg_priority [消息的优先级]
     * @param     array|null $offline_push_info [离线推送信息配置]
     * @param     array|null $forbid_callback_control [消息回调禁止开关]
     * @param     int|null $online_only_flag [1表示消息仅发送在线成员，默认0表示发送所有成员，音视频聊天室（AVChatRoom）和在线成员广播大群（BChatRoom）不支持该参数]
     * @return    [type] [description]
     */
    public function send_group_msg(string $group_id, array $msg_body, string $from_account = null, string $msg_priority = null, array $offline_push_info = null, array $forbid_callback_control = null, int $online_only_flag = null)
    {
        return $this->api('group_open_http_svc', 'send_group_msg', [
            'GroupId' => $group_id,
            'Random' => mt_rand(0, 4294967295),
            'MsgPriority' => $msg_priority,
            'MsgBody' => $msg_body,
            'From_Account' => $from_account,
            'OfflinePushInfo' => $offline_push_info,
            'ForbidCallbackControl' => $forbid_callback_control,
            'OnlineOnlyFlag' => $online_only_flag
        ]);
    }

    /**
     * [send_group_system_notification 在群组中发送系统通知]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T14:26:52+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [向哪个群组发送系统通知]
     * @param     string $content [系统通知的内容]
     * @param     array|null $to_members_account [接收者群成员列表，不填或为空表示全员下发]
     * @return    [type] [description]
     */
    public function send_group_system_notification(string $group_id, string $content, array $to_members_account = null)
    {
        return $this->api('group_open_http_svc', 'send_group_system_notification', [
            'GroupId' => $group_id,
            'ToMembers_Account' => $to_members_account,
            'Content' => $content
        ]);
    }

    /**
     * [group_msg_recall 撤回群组消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T14:39:00+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [操作的群 ID]
     * @param     array $msg_seq_list [被撤回的消息 seq 列表，一次请求最多可以撤回10条消息 seq]
     * @return    [type] [description]
     */
    public function group_msg_recall(string $group_id, array $msg_seq_list)
    {
        return $this->api('group_open_http_svc', 'group_msg_recall', [
            'GroupId' => $group_id,
            'MsgSeqList' => array_map(function ($id) {
                return ['MsgSeq' => (int) $id];
            }, $msg_seq_list)
        ]);
    }

    /**
     * [change_group_owner 转让群组]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T14:46:24+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [要被转移的群组 ID]
     * @param     string $new_owner_account [新群主 ID]
     * @return    [type] [description]
     */
    public function change_group_owner(string $group_id, string $new_owner_account)
    {
        return $this->api('group_open_http_svc', 'change_group_owner', [
            'GroupId' => $group_id,
            'NewOwner_Account' => $new_owner_account
        ]);
    }

    /**
     * [import_group 导入群基础资料]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T14:52:13+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $name [群名称，最长30字节]
     * @param     string $type [群组形态，包括 Public（公开群），Private（私密群）， ChatRoom（聊天室）]
     * @param     string|null $owner_account [群主 ID，自动添加到群成员中。如果不填，群没有群主]
     * @param     string|null $group_id [为了使得群组 ID 更加简单，便于记忆传播，腾讯云支持 App 在通过 REST API 创建群组时自定义群组 ID。详细请参阅 群组系统]
     * @param     int|null $create_time [群组的创建时间]
     * @param     int|null $max_member_count [最大群成员数量，最大为6000，不填默认为2000个]
     * @param     string|null $apply_join_option [申请加群处理方式。包含 FreeAccess（自由加入），NeedPermission（需要验证），DisableApply（禁止加群），不填默认为NeedPermission（需要验证）]
     * @param     string|null $introduction [群简介，最长240字节]
     * @param     string|null $notification [群公告，最长300字节]
     * @param     string|null $face_url [群头像 URL，最长100字节]
     * @param     array|null $app_defined_data [群组维度的自定义字段，默认情况是没有的，需要开通，详细请参阅 群组系统]
     * @return    [type] [description]
     */
    public function import_group(string $name, string $type, string $owner_account = null, string $group_id = null, int $create_time = null, int $max_member_count = null, string $apply_join_option = null, string $introduction = null, string $notification = null, string $face_url = null, array $app_defined_data = null)
    {
        return $this->api('group_open_http_svc', 'import_group', [
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
            'CreateTime' => $create_time
        ]);
    }

    /**
     * [import_group_msg description]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T14:57:00+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [要导入消息的群 ID]
     * @param     array $msg_list [导入的消息列表]
     * @return    [type] [description]
     */
    public function import_group_msg(string $group_id, array $msg_list)
    {
        return $this->api('group_open_http_svc', 'import_group_msg', [
            'GroupId' => $group_id,
            'MsgList' => $msg_list
        ]);
    }

    /**
     * [import_group_member description]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T14:59:42+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [操作的群 ID]
     * @param     array $member_list [待添加的群成员数组]
     * @return    [type] [description]
     */
    public function import_group_member(string $group_id, array $member_list)
    {
        return $this->api('group_open_http_svc', 'import_group_member', [
            'GroupId' => $group_id,
            'MemberList' => $member_list
        ]);
    }

    /**
     * [set_unread_msg_num 设置成员未读消息计数]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T15:06:55+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [操作的群 ID]
     * @param     string $member_account [要操作的群成员]
     * @param     int $unread_msg_num [成员未读消息数]
     */
    public function set_unread_msg_num(string $group_id, string $member_account, int $unread_msg_num)
    {
        return $this->api('group_open_http_svc', 'set_unread_msg_num', [
            'GroupId' => $group_id,
            'Member_Account' => $member_account,
            'UnreadMsgNum' => $unread_msg_num
        ]);
    }

    /**
     * [delete_group_msg_by_sender 删除指定用户发送的消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T15:08:09+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [要删除消息的群 ID]
     * @param     string $sender_account [被删除消息的发送者 ID]
     * @return    [type] [description]
     */
    public function delete_group_msg_by_sender(string $group_id, string $sender_account)
    {
        return $this->api('group_open_http_svc', 'delete_group_msg_by_sender', [
            'GroupId' => $group_id,
            'Sender_Account' => $sender_account
        ]);
    }

    /**
     * [group_msg_get_simple 拉取群漫游消息]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T15:19:24+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $group_id [要拉取漫游消息的群组 ID]
     * @param     int $req_msg_number [拉取的漫游消息的条数，目前一次请求最多返回20条漫游消息，所以这里最好小于等于20]
     * @param     int|null $req_msg_seq [拉取消息的最大 seq]
     * @return    [type] [description]
     */
    public function group_msg_get_simple(string $group_id, int $req_msg_number, int $req_msg_seq = null)
    {
        return $this->api('group_open_http_svc', 'group_msg_get_simple', [
            'GroupId' => $group_id,
            'ReqMsgNumber' => $req_msg_number,
            'ReqMsgSeq' => $req_msg_seq
        ]);
    }

    /**
     * 全局禁言管理 openconfigsvr
     */

    /**
     * [setnospeaking 设置全局禁言]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T15:27:53+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $set_account [设置禁言配置的帐号]
     * @param     int|null $c2cmsg_nospeaking_time [单聊消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）。等于0代表取消帐号禁言；等于最大值4294967295（十六进制 0xFFFFFFFF）代表帐号被设置永久禁言；其它代表该帐号禁言时间]
     * @param     int|null $groupmsg_nospeaking_time [群组消息禁言时间，单位为秒，非负整数，最大值为4294967295（十六进制 0xFFFFFFFF）。等于0代表取消帐号禁言；最大值4294967295（十六进制 0xFFFFFFFF）代表帐号被设置永久禁言；其它代表该帐号禁言时间]
     * @return    [type] [description]
     */
    public function setnospeaking(string $set_account, int $c2cmsg_nospeaking_time = null, int $groupmsg_nospeaking_time = null)
    {
        return $this->api('openconfigsvr', 'setnospeaking', [
            'Set_Account' => $set_account,
            'C2CmsgNospeakingTime' => $c2cmsg_nospeaking_time,
            'GroupmsgNospeakingTime' => $groupmsg_nospeaking_time
        ]);
    }

    /**
     * [getnospeaking 查询全局禁言]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T15:33:52+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $get_account [查询禁言信息的帐号]
     * @return    [type] [description]
     */
    public function getnospeaking(string $get_account)
    {
        return $this->api('openconfigsvr', 'getnospeaking', [
            'Get_Account' => $get_account
        ]);
    }

    /**
     * 运营管理 open_msg_svc getappinfo
     */

    /**
     * [get_history 下载消息记录]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T15:36:11+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $chat_type [消息类型，C2C 表示单发消息 Group 表示群组消息]
     * @param     string $msg_time [需要下载的消息记录的时间段，2015120121表示获取2015年12月1日21:00 - 21:59的消息的下载地址。该字段需精确到小时。每次请求只能获取某天某小时的所有单发或群组消息记录]
     * @return    [type] [description]
     */
    public function get_history(string $chat_type, string $msg_time)
    {
        return $this->api('open_msg_svc', 'get_history', [
            'ChatType' => $chat_type,
            'MsgTime' => $msg_time
        ]);
    }

    /**
     * [getappinfo 拉取运营数据]
     * @Author    ZiShang520@gmail.com
     * @DateTime  2020-01-16T15:37:12+0800
     * @copyright (c) ZiShang520 All Rights Reserved
     * @param     string $request_field [该字段用来指定需要拉取的运营数据，不填默认拉取所有字段。详细可参阅下文可拉取的运营字段]
     * @return    [type] [description]
     */
    public function getappinfo(array $request_field)
    {
        return $this->api('openconfigsvr', 'getappinfo', [
            'RequestField' => $request_field
        ]);
    }
}
