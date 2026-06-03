<?php

function securite_hashPassword(string $password): string {
    return hash(HASH_ALGO, $password);
}

function securite_verifyPassword(string $password, string $hash): bool {
    return hash(HASH_ALGO, $password) === $hash;
}