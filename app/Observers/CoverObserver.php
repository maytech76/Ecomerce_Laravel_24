<?php

namespace App\Observers;
use App\Models\Cover;

class CoverObserver
{
    public function creating(Cover $cover)
    {
       /* cada vez que se registre un nuevo cover
       Busca el maximo registro en la tabla cover en el campo order y sumale 1 */
      $cover->order = Cover::max('order') + 1;

    }
}
