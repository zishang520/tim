<?php

namespace luoyy\Tim;

/**
 * Tim Tag.
 */
class Tag
{
    /**
     * 昵称.
     */
    public const TAG_PROFILE_IM_NICK = 'Tag_Profile_IM_Nick';

    /**
     * 性别.
     */
    public const TAG_PROFILE_IM_GENDER = 'Tag_Profile_IM_Gender';

    /**
     * 生日.
     */
    public const TAG_PROFILE_IM_BIRTHDAY = 'Tag_Profile_IM_BirthDay';

    /**
     * 所在地.
     */
    public const TAG_PROFILE_IM_LOCATION = 'Tag_Profile_IM_Location';

    /**
     * 个性签名.
     */
    public const TAG_PROFILE_IM_SELFSIGNATURE = 'Tag_Profile_IM_SelfSignature';

    /**
     * 加好友验证方式.
     */
    public const TAG_PROFILE_IM_ALLOWTYPE = 'Tag_Profile_IM_AllowType';

    /**
     * 语言
     */
    public const TAG_PROFILE_IM_LANGUAGE = 'Tag_Profile_IM_Language';

    /**
     * 头像URL.
     */
    public const TAG_PROFILE_IM_IMAGE = 'Tag_Profile_IM_Image';

    /**
     * 消息设置.
     */
    public const TAG_PROFILE_IM_MSGSETTINGS = 'Tag_Profile_IM_MsgSettings';

    /**
     * 管理员禁止加好友标识.
     */
    public const TAG_PROFILE_IM_ADMINFORBIDTYPE = 'Tag_Profile_IM_AdminForbidType';

    /**
     * 等级.
     */
    public const TAG_PROFILE_IM_LEVEL = 'Tag_Profile_IM_Level';

    /**
     * 角色.
     */
    public const TAG_PROFILE_IM_ROLE = 'Tag_Profile_IM_Role';

    /**
     * 好友分组： 1. 最多支持 32 个分组； 2. 不允许分组名为空； 3. 分组名长度不得超过 30 个字节； 4. 同一个好友可以有多个不同的分组.
     */
    public const TAG_SNS_IM_GROUP = 'Tag_SNS_IM_Group';

    /**
     * 好友备注： 1. 备注长度最长不得超过 96 个字节
     */
    public const TAG_SNS_IM_REMARK = 'Tag_SNS_IM_Remark';

    /**
     * 加好友来源： 1. 加好友来源字段包含前缀和关键字两部分； 2. 加好友来源字段的前缀是：AddSource_Type_ ； 3. 关键字：必须是英文字母，且长度不得超过 8 字节，建议用一个英文单词或该英文单词的缩写； 4. 示例：加好友来源的关键字是 Android，则加好友来源字段是：AddSource_Type_Android.
     */
    public const TAG_SNS_IM_ADDSOURCE = 'Tag_SNS_IM_AddSource';

    /**
     * 加好友附言： 1. 加好友附言的长度最长不得超过 256 个字节
     */
    public const TAG_SNS_IM_ADDWORDING = 'Tag_SNS_IM_AddWording';

    /**
     * 表示单向加好友.
     */
    public const ADD_TYPE_SINGLE = 'Add_Type_Single';

    /**
     * 表示双向加好友.
     */
    public const ADD_TYPE_BOTH = 'Add_Type_Both';

    /**
     * 只会检查 From_Account 的好友表中是否有 To_Account，不会检查 To_Account 的好友表中是否有 From_Account.
     */
    public const DELETE_TYPE_SINGLE = 'Delete_Type_Single';

    /**
     * 既会检查 From_Account 的好友表中是否有 To_Account，也会检查 To_Account 的好友表中是否有 From_Account.
     */
    public const DELETE_TYPE_BOTH = 'Delete_Type_Both';

    /**
     * 只会检查 From_Account 的好友表中是否有 To_Account，不会检查 To_Account 的好友表中是否有 From_Account.
     */
    public const CHECKRESULT_TYPE_SINGLE = 'CheckResult_Type_Single';

    /**
     * 既会检查 From_Account 的好友表中是否有 To_Account，也会检查 To_Account 的好友表中是否有 From_Account.
     */
    public const CHECKRESULT_TYPE_BOTH = 'CheckResult_Type_Both';

    /**
     * 只会检查 From_Account 的黑名单中是否有 To_Account，不会检查 To_Account 的黑名单中是否有 From_Account.
     */
    public const BLACKCHECKRESULT_TYPE_SINGLE = 'BlackCheckResult_Type_Single';

    /**
     * 既会检查 From_Account 的黑名单中是否有 To_Account，也会检查 To_Account 的黑名单中是否有 From_Account.
     */
    public const BLACKCHECKRESULT_TYPE_BOTH = 'BlackCheckResult_Type_Both';
}
