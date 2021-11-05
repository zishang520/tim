<?php

namespace luoyy\Tim;

class Type
{
    public const WORK_ROOM = 'Work';

    public const PUBLIC_ROOM = 'Public';

    public const MEETING_ROOM = 'Meeting';

    public const AV_CHAT_ROOM = 'AVChatRoom';

    /**
     * 使用 Work 替代.
     * @deprecated
     */
    public const PRIVATE_ROOM = 'Private';

    /**
     * 使用 Meeting 替代.
     * @deprecated
     */
    public const CHAT_ROOM = 'ChatRoom';

    /**
     * 无替代方案，可以考虑 AVChatRoom.
     * @deprecated
     */
    public const B_CHAT_ROOM = 'BChatRoom';
}
