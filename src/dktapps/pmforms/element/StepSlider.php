<?php

/*
 * This file is part of pmforms.
 * Copyright (C) 2018-2025 Dylan K. Taylor <https://github.com/dktapps-pm-pl/pmforms>
 *
 * pmforms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace dktapps\pmforms\element;

class StepSlider extends BaseSelector{

	public function getType() : string{
		return "step_slider";
	}

	protected function serializeElementData() : array{
		return [
			"steps" => $this->options,
			"default" => $this->defaultOptionIndex
		];
	}
}
