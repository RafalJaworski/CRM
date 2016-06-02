<?php

namespace AppBundle\Helper;

class Message
{
    const TYPE_WARNING = 'warning';
    const TYPE_SUCCESS = 'success';
    const TYPE_INFO = 'info';
    const TYPE_DANGER = 'danger';

    const MSG_SUCCESS = 'Successfully saved!';
    const MSG_EXISTS = 'Sorry! Changes has not been saved. This entry exists!';
    const MSG_EMPTY = 'Sorry! Nothing to show!';
    const MSG_FAILURE = 'Changes has not be saved';
}

