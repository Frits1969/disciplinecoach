<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : HtmlView.php
 * Path        : site/src/View/Disciplines/HtmlView.php
 * Purpose     : Prepares the frontend discipline selection page.
 *               Loads disciplines and the current Joomla user.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-11-11
 * Modified    : 2026-11-12
 * Version     : 0.1.4
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

namespace Fvl\Component\DisciplineCoach\Site\View\Disciplines;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use RuntimeException;

/**
 * Frontend view for selecting disciplines.
 */
class HtmlView extends BaseHtmlView
{
    /**
     * Published disciplines in the active content language.
     *
     * @var array
     */
    protected array $items = [];

    /**
     * Current Joomla user identity.
     *
     * @var object|null
     */
    protected ?object $identity = null;

    /**
     * Indicates whether a registered user is logged in.
     *
     * @var bool
     */
    protected bool $isLoggedIn = false;

    /**
     * URL of the current discipline selection page.
     *
     * @var string
     */
    protected string $returnUrl = '';

    /**
     * Joomla login URL containing the current page as return URL.
     *
     * @var string
     */
    protected string $loginUrl = '';

    /**
     * Joomla registration URL.
     *
     * @var string
     */
    protected string $registrationUrl = '';

    /**
     * Displays the frontend discipline selection page.
     *
     * @param string|null $tpl Optional template name.
     *
     * @return void
     *
     * @throws RuntimeException
     */
    public function display($tpl = null): void
    {
        $application = Factory::getApplication();

        $this->identity = $application->getIdentity();

        $this->isLoggedIn = (
            (int) ($this->identity->id ?? 0) > 0
        );

        $this->items = $this->get('Items');

        $errors = $this->get('Errors');

        if (!empty($errors)) {
            throw new RuntimeException(
                implode(
                    PHP_EOL,
                    array_map(
                        static function ($error): string {
                            return $error instanceof \Throwable
                                ? $error->getMessage()
                                : (string) $error;
                        },
                        $errors
                    )
                )
            );
        }

        $this->prepareUrls();

        parent::display($tpl);
    }

    /**
     * Prepares the login and registration URLs.
     *
     * @return void
     */
    private function prepareUrls(): void
    {
        $this->returnUrl = Uri::getInstance()->toString();

        $encodedReturnUrl = base64_encode(
            $this->returnUrl
        );

        $this->loginUrl = Route::_(
            'index.php?option=com_users'
            . '&view=login'
            . '&return='
            . rawurlencode($encodedReturnUrl)
        );

        $this->registrationUrl = Route::_(
            'index.php?option=com_users'
            . '&view=registration'
        );
    }
}
