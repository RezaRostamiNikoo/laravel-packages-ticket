<?php

namespace Rostami\Ticket\App\Traits;

use Illuminate\Database\Eloquent\Model;
use Rostami\Ticket\App\Models\TicketSetting;
use Mews\Purifier\Facades\Purifier;
trait Purifiable
{
    /**
     * Updates the content and html attribute of the given model.
     *
     * @param string $rawHtml
     *
     * @return Model $this
     */
    public function setPurifiedContent($rawHtml)
    {
        $this->content = Purifier::clean($rawHtml, ['HTML.Allowed' => '']);
        $this->html = Purifier::clean($rawHtml, TicketSetting::grab('purifier_config'));

        return $this;
    }
}
