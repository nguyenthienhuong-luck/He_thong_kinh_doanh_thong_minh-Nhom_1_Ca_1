<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TransactionModal extends Component
{
  public $user;
  public $groupTypes;
  public $categories;

  public function __construct($user, $groupTypes, $categories)
  {
    $this->user = $user;
    $this->groupTypes = $groupTypes;
    $this->categories = $categories;
  }

  public function render()
  {
    return view('components.transaction-modal');
  }
}
