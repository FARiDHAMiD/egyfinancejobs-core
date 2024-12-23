<div id="list-example" class="list-group">
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_general_info' ? 'active' : '' }}" href="{{route('employee.profile.general-info.edit')}}">General
        Info</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_career_inetrests' ? 'active' : '' }}" href="{{route('employee.profile.career-inetrests.edit')}}">Career
        Inetrests</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_experiences' ? 'active' : '' }}" href="{{route('employee.profile.experiences.edit')}}">Experience</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_educations' ? 'active' : '' }}" href="{{route('employee.profile.educations.edit')}}">Education</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_skills' ? 'active' : '' }}" href="{{route('employee.profile.skills.edit')}}">Skills</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_online_presence' ? 'active' : '' }}" href="{{route('employee.profile.online-presence.edit')}}">Online
        Presence</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_cv' ? 'active' : '' }}" href="{{route('employee.profile.cv.edit')}}">Upload CV</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_achievements' ? 'active' : '' }}" href="{{route('employee.profile.achievements.edit')}}">Achievements</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'edit_certificates' ? 'active' : '' }}" href="{{route('employee.profile.certificates.edit')}}">Certificates</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'change_password' ? 'active' : '' }}" href="{{route('employee.profile.change_password.edit')}}">Change Password</a>
    <a class="list-group-item list-group-item-action {{isset($page_name) && $page_name == 'delete_account' ? 'active' : '' }}" href="{{route('employee.profile.delete_account.page')}}">Delete Account</a>
</div>