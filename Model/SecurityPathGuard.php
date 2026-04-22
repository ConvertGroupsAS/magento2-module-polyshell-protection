<?php

declare(strict_types=1);

namespace Aregowe\PolyShellProtection\Model;

class SecurityPathGuard
{
    private const BLOCKED_PATH_PREFIXES = [
        '/media/customer_address',
        '/pub/media/customer_address',
        '/media/customer_addresses',
        '/pub/media/customer_addresses',
        '/media/custom_options',
        '/pub/media/custom_options',
    ];

    public function isBlockedRequestPath(string $pathInfo): bool
    {
        $normalized = '/' . ltrim(trim($pathInfo), '/');

        foreach (self::BLOCKED_PATH_PREFIXES as $prefix) {
            if ($normalized === $prefix || strpos($normalized, $prefix . '/') === 0) {
                return true;
            }
        }

        return false;
    }

    public function isBlockedMediaRelativePath(string $relativeMediaPath): bool
    {
        $normalized = '/' . ltrim(trim($relativeMediaPath), '/');

        return strpos($normalized, '/customer_address/') === 0
            || $normalized === '/customer_address'
            || strpos($normalized, '/customer_addresses/') === 0
            || $normalized === '/customer_addresses'
            || strpos($normalized, '/custom_options/') === 0
            || $normalized === '/custom_options';
    }
}
