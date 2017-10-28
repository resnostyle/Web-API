<?php

namespace App\Transformers;

use App\Release;
use League\Fractal\TransformerAbstract;

class ReleaseTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Release $release)
    {
        return [
            'name'      => $release->name,
            'guid'      => $release->guid
        ];
    }
}
