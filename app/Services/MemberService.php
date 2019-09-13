<?php

namespace App\Services;

use App\Models\Member;

class MemberService
{
    /**
     * Crates a member with given data.
     *
     * @param array $post
     *
     * @return Member
     */
    public function insert($post)
    {
        $member = Member::create([
            'firstname' => $post['firstname'] ?? null,
            'lastname' => $post['lastname'] ?? null,
            'birthdate' => $post['birthdate'] ?? null,
            'report' => $post['report'] ?? null,
            'country_id' => $post['country_id'] ?? null,
            'phone' => $post['phone'] ?? null,
            'email' => $post['email'] ?? null,
        ]);

        return $member;
    }

    /**
     * Crates a member with given data.
     *
     * @param array $post
     *
     * @return bool
     */
    public function update($post, $id)
    {
        $result = Member::where('id', $id)
            ->update([
                'company' => $post['company'] ?? null,
                'position' => $post['position'] ?? null,
                'about' => $post['about'] ?? null,
                'original_file_name' => $post['original_file_name'] ?? null,
                'hash_file_name' => $post['hash_file_name'] ?? null,
            ]);

        return $result;
    }

    /**
     * Removes given member.
     *
     * @param Member $member
     *
     * @return bool
     */
    public function delete(Member $member)
    {
        return $member->delete();
    }

    /**
     * Restores given member.
     *
     * @param Member $member
     *
     * @return bool
     */
    public function restore(Member $member)
    {
        return $member->restore();
    }
}
