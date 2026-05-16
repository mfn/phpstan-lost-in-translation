<?php
/**
 * Copyright (c) anno Domini nostri Jesu Christi MMXXV John Boehr & contributors
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types = 1);
namespace Mfn\PHPStanLostInTranslation\Tests;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Mfn\PHPStanLostInTranslation\Utils;
use Orchestra\Testbench\TestCase;

final class UtilsTest extends TestCase
{
    public function testEscapeInvalidUnicodeFallback(): void
    {
        self::assertSame('"\\xc3("', Utils::e("\xc3\x28"));
    }

    public function testFormatTipForKeyValue(): void
    {
        self::assertStringContainsString('Key: ', Utils::formatTipForKeyValue('locale', 'key'));
        self::assertStringContainsString('Key: ', Utils::formatTipForKeyValue('locale', 'key', 'value'));
        self::assertStringContainsString('Value: ', Utils::formatTipForKeyValue('locale', 'key', 'value'));
    }

    public function testDetectLangPath(): void
    {
        $app = $this->app;
        self::assertNotNull($app);

        self::assertSame($app->langPath(), Utils::detectLangPath());

        $original = $app::getInstance();

        try {
            $app::setInstance();

            self::assertSame('lang', Utils::detectLangPath());

            $app::setInstance(new Container);
            self::assertSame('lang', Utils::detectLangPath());
        } finally {
            $app::setInstance($original);
        }
    }

    public function testDetectLangPathWithNoApplicationClass(): void
    {
        self::assertSame('lang', Utils::detectLangPath(null));
    }

    public function testDetectLangPathWithUnbootedApplication(): void
    {
        $app = self::createStub(\Illuminate\Contracts\Foundation\Application::class);
        $original = Application::getInstance();

        try {
            Application::setInstance($app);

            self::assertSame('lang', Utils::detectLangPath());
        } finally {
            Application::setInstance($original);
        }
    }

    public function testDetectBaseLocaleWithNoApplication(): void
    {
        self::assertSame('en', Utils::detectBaseLocale(null));
    }

    public function testDetectBaseLocaleWithUnbootedApplication(): void
    {
        $app = self::createStub(\Illuminate\Contracts\Foundation\Application::class);
        $original = Application::getInstance();

        try {
            Application::setInstance($app);

            self::assertSame('en', Utils::detectBaseLocale());
        } finally {
            Application::setInstance($original);
        }
    }
}
