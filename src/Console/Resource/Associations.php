<?php
namespace Inviqa\JumpCloud\Api\Console\Resource;

interface Associations
{
    const TARGET_APPLICATION = 'application';
    const TARGET_COMMAND = 'command';
    const TARGET_G_SUITE = 'g_suite';
    const TARGET_LDAP_SERVER = 'ldap_server';
    const TARGET_OFFICE_365 = 'office_365';
    const TARGET_POLICY = 'policy';
    const TARGET_RADIUS_SERVER = 'radius_server';
    const TARGET_SYSTEM = 'system';
    const TARGET_SYSTEM_GROUP = 'system_group';
    const TARGET_USER = 'user';
    const TARGET_USER_GROUP = 'user_group';

    public function getName();
    public function fetch($resource_id, $targets, $options = []);
    public function post($resource_id, $data);
}
