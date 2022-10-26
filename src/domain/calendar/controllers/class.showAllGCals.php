<?php

namespace leantime\domain\controllers {

    /**
     * newUser Class - show all User
     *
     */

    use leantime\core;
    use leantime\core\events;
    use leantime\domain\models\auth\roles;
    use leantime\domain\repositories;
    use leantime\domain\services\auth;

    class showAllGCals
    {

        /**
         * run - display template and edit data
         *
         * @access public
         */
        public function run()
        {
            auth::authOrRedirect([roles::$owner, roles::$admin, roles::$manager, roles::$editor]);

            $tpl = new core\template();
            $calendarRepo = new repositories\calendar();

            events::dispatch_event('begin', [
                'this' => $this,
                'tplInstance' => $tpl,
                'calendarRepo' => $calendarRepo,
            ]);

            //Assign vars
            $tpl->assign('allCalendars', $calendarRepo->getMyGoogleCalendars());


            $tpl->display('calendar.showAllGCals');

            events::dispatch_event('end');

        }

    }
}

