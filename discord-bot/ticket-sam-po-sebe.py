import discord
from discord.ext import commands
from discord.utils import get
from asyncio import sleep

intents = discord.Intents.default()
intents.reactions = True
intents.messages = True
intents.guilds = True
intents.members = True
intents.message_content = True

bot = commands.Bot(command_prefix='!', intents=intents)

@bot.event
async def on_ready():
    print('Bot is ready')

@bot.event
async def on_raw_reaction_add(payload):
    guild_id = 1123971136611422210
    category_id = 1124211068491800639
    channel_id = 1124211118513066004
    message_id = 1125837310290829333
    ticket_emoji = '✅'
    close_emoji = '❌'
    confirm_emoji = '🆗'

    if payload.guild_id == guild_id and payload.channel_id == channel_id and payload.message_id == message_id and str(payload.emoji) == ticket_emoji:
        guild = bot.get_guild(guild_id)
        category = get(guild.categories, id=category_id)
        ticket_number = len(category.channels) + 1
        ticket_channel_name = f'Тикет - {ticket_number:04}'
        ticket_channel = await category.create_text_channel(ticket_channel_name)
        close_message = await ticket_channel.send('Закрыть тикет, нажмите ❌')
        await close_message.add_reaction(close_emoji)
        
        overwrites = {
            guild.default_role: discord.PermissionOverwrite(read_messages=False),
            payload.member: discord.PermissionOverwrite(read_messages=True)
        }
        await ticket_channel.edit(overwrites=overwrites)
        print(f"Создан канал-тикет: {ticket_channel_name}")

    elif payload.guild_id == guild_id and payload.channel_id != channel_id:
        ticket_channel = bot.get_channel(payload.channel_id)
        close_message = await ticket_channel.fetch_message(payload.message_id)
        
        if str(payload.emoji) == close_emoji:
            confirm_message = await ticket_channel.send('Вы уверены, нажмите 🆗')
            await confirm_message.add_reaction(confirm_emoji)
            print(f"Появился запрос на подтверждение удаления канала: {ticket_channel.name}")
        
        elif str(payload.emoji) == confirm_emoji:
            await ticket_channel.send('Через 5 секунд, канал будет удален')
            await sleep(5)
            await ticket_channel.delete()
            print(f"Канал удален: {ticket_channel.name}")

bot.run('MTEyNTgwMTY1MTQ1OTA3MjExMA.GXGgbR.HP2hbrx7VhC1ZcmjmYD8OTohPoXPzW_oxjFEdk')