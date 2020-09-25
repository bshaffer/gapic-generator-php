<?php
/*
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
declare(strict_types=1);

namespace Google\Generator\Ast;

use Google\Generator\Collections\Vector;

class Access
{
    public const PUBLIC = 'public';
    public const STATIC = 'static';
}

trait HasAccess
{
    /**
     * Create a version of this ast element with access modifiers.
     *
     * @param array $access All access modifiers.
     *
     * @return self
     */
    public function withAccess(...$access): self
    {
        return $this->clone(fn($clone) => $clone->access = Vector::new($access));
    }

    protected function accessToCode(): string
    {
        return isset($this->access) ? $this->access->map(fn($x) => "{$x} ")->join() : '';
    }
}
