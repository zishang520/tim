<?php
namespace luoyy\Tim;

class Type
{
    const WORK_ROOM = 'Work';
    const PUBLIC_ROOM = 'Public';
    const MEETING_ROOM = 'Meeting';
    const AV_CHAT_ROOM = 'AVChatRoom';

    /**
     * 使用 Work 替代
     * @deprecated
     */
    const PRIVATE_ROOM = 'Private';
    /**
     * 使用 Meeting 替代
     * @deprecated
     */
    const CHAT_ROOM = 'ChatRoom';

     /**
     * 无替代方案，可以考虑 AVChatRoom
     * @deprecated
     */
    const B_CHAT_ROOM = 'BChatRoom';
}
