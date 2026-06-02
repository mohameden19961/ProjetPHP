<?php

function securite_hashPassword(string $password): string {
    return hash('sha256', $password);
}

function securite_verifyPassword(string $password, string $hash): bool {
    return hash('sha256', $password) === $hash;
}