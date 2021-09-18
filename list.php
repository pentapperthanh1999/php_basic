<?php
    if (! empty($result)) {
        foreach ($result as $row) {
?>

<tr class="row_element">
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['password']; ?></td>
    <td><?php echo $row['fullname']; ?></td>
    <td><?php echo $row['day_of_birth']; ?></td>
    <td>
        <img 
            class="avatar-cover" 
            src="<?php echo $row['avatar']; ?>"
        />
    </td>
    <td><?php echo ($row['is_active'] == 1 ? 'active': 'disable'); ?></td>
    <td class="action">
        <button 
            type="button" 
            class="btn btn-primary" 
            data-toggle="modal" 
            data-target="#showModal"
        >
            <i class="far fa-eye"></i>
        </button>
        <button 
            type="button" 
            class="btn btn-warning btn-edit" 
            data-toggle="modal" 
            data-target="#editModal"
            id="<?php echo $row['id']; ?>"
        >
            <i class="far fa-edit"></i>
        </button>
        <button 
            type="button"
            class="btn btn-danger btn-delete" 
            id="<?php echo $row['id']; ?>"
        >
            <i class="far fa-trash-alt"></i>
        </button>
    </td>
</tr>
<?php
    }
}
?>
